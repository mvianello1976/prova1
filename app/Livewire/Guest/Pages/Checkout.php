<?php

namespace App\Livewire\Guest\Pages;

use App\Livewire\Forms\UserForm;
use App\Mail\SendGiftCard;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\GiftCardUser;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use function App\Helpers\generateTicket;

#[Layout('layouts.guest')]
class Checkout extends Component
{
    public UserForm $form;

    public $cart = null;

    public $coupon_code = null;

    public $coupon = null;

    public $steps = [
        1 => 'I tuoi dati',
        2 => 'Pagamento',
        3 => 'Fatto!',
    ];

    public $currentStep = 1;

    public function mount()
    {
        $this->setCart();

        if ($this->cart) {
            foreach ($this->cart->items as $item) {
                $item->update([
                    'to_pay' => $this->cart->splitPayment($item)
                ]);
            }
        }
    }

    public function setCart()
    {
        if (auth()->check()) {
            $this->form->setUser(auth()->user());

            if (!auth()->user()->cart) {
                if (session('guest_id')) {
                    $this->cart = \App\Models\Cart::where('user_id', session('guest_id'))->first();
                    $this->cart->update([
                        'user_id' => auth()->id(),
                    ]);
                    session()->remove('guest_id');
                }
            } else {
                $this->cart = auth()->user()->cart;
            }
        } else {
            $this->cart = \App\Models\Cart::where('user_id', session('guest_id'))->first();
        }

        if (!$this->cart) {
            return redirect()->route('guest.index');
        }
    }

    public function next()
    {
        match ($this->currentStep) {
            1 => call_user_func(function () {
                $this->form->update();

                if ($this->checkIfPastEventsExists()) {
                    if ($this->cart->total_price_after_discount == 0) {
                        $this->checkIfPastEventsExists();

                        $this->generateOrder();
                        $this->currentStep = 3;
                    } else {
                        $this->checkIfPastEventsExists();
                        $this->currentStep++;
                    }
                }
            }),
            2 => call_user_func(function () {
                $this->generateOrder();
                $this->currentStep++;
            })
        };
    }

    protected function checkIfPastEventsExists()
    {
        $check = true;
        // Verifico se la data e l'orario dell'evento nel carrello sono passati rispetto all'orario attuale
        foreach ($this->cart->items as $item) {
            match ($item->type) {
                'product' => call_user_func(function () use ($item, &$check) {
                    $availability = $item->time;

                    $selectedDateTime = Carbon::parse($availability->date.' '.$availability->time);

                    if ($selectedDateTime <= now()) {
                        $this->addError('date_past', 'Uno o più elementi nel tuo carrello hanno data/orario passati. Ti preghiamo di rimuoverli o modificare la prenotazione per continuare.');

                        $check = false;
                        return false;
                    }

                    $check = true;
                    return true;
                }),
                'gift-card' => call_user_func(function () use ($item, &$check) {
                    $check = true;
                    return true;
                })
            };
        }

        return $check;
    }

    protected function generateOrder()
    {
        // TODO: Pagamento delle attività che necessitano di "pagamento immediato"
        if ($this->cart->items->count()) {
            foreach ($this->cart->items as $item) {
                match ($item->type) {
                    'product' => call_user_func(function () use ($item) {
                        $product = $item->product;
                        if ($product->payment_type) {
                            match ($product->payment_type) {
                                'cash' => call_user_func(function () use ($item, $product) {
                                    // Pagamento in contanti:
                                    $services = Service::whereIn('id', json_decode($item->services))->get();
                                    $data = [
                                        'booking' => [
                                            'date' => $item->time->date,
                                            'time' => $item->time->time,
                                            'time_id' => $item->time->id,
                                            'duration' => $product->duration,
                                            'participants' => [
                                                'total' => $item->participants,
                                                'adults' => $item->adults,
                                                'kids' => $item->kids,
                                                'children' => $item->children,
                                            ],
                                            'services' => $services,
                                            'total' => (double) $item->total_price,
                                        ],
                                        'product' => [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'destination' => $product->destination->name,
                                            'category' => $product->category->name,
                                            'typology' => $product->typology->name,
                                        ],
                                    ];

                                    if ($item->product->isRental()) {
                                        // Aumento il contatore "sold"
                                        $item->time->increment('sold');
                                        // Riduco il contatore "booked";
                                        $item->time->decrement('booked');
                                    } else {
                                        // Aumento il contatore "sold"
                                        $item->time->increment('sold', $item->participants);
                                        // Riduco il contatore "booked";
                                        $item->time->decrement('booked', $item->participants);
                                    }

                                    // Creo l'ordine
                                    $order = auth()->user()->orders()->create([
                                        'uuid' => strtoupper(Str::random()),
                                        'cart_id' => $this->cart->id,
                                        'partner_id' => $product->user_id,
                                        'data' => $data,
                                        'payment_method' => 'cash',
                                        'payment_status' => $item->showPriceAfterDiscount() > 0 ? 'unpaid' : 'paid',
                                        'paid_at' => $item->showPriceAfterDiscount() > 0 ? null : now(),
                                        'has_deposit' => true,
                                        'deposit' => $item->calculateDeposit($item->showPriceAfterDiscount()),
                                        'total' => $item->showPriceAfterDiscount(),
                                        'used_balance' => $item->to_pay,
                                        'coupon' => $item->coupon ?? null,
                                        'status' => $product->booking_type === 'direct' ? 'approved' : 'to_approve',
                                        'approval_deadline' => $item->is_gift ? null : now()->addHours(env('APPROVAL_DEADLINE_HOURS', 24)),
                                        'is_gift' => $item->gift,
                                        'gift_from' => $item->is_gift ? auth()->id() : null,
                                        'gift_data' => $item->is_gift ? [
                                            'receiver_name' => $item->receiver_name,
                                            'receiver_email' => $item->receiver_email,
                                            'receiver_message' => $item->receiver_message,
                                        ] : null,
                                        'redeem_code' => $item->gift ? strtoupper(Str::random(10)) : null
                                    ]);

                                    logger("Ordine {$order->uuid}: pagare {$item->to_pay}€ al B2B '{$item->product->user->fullname}'");

                                    // Riduco saldo account
                                    auth()->user()->removeBalance($item->to_pay);

                                    if ($order) {
                                        // Controllo se l'esperienza acquistata è un noleggio
                                        if ($item->product->isRental()) {
                                            // Se è un noleggio, genero un solo Ticket
                                            generateTicket($order);
                                        } else {
                                            // Se non è un noleggio, genero tanti Ticket quanto il numero dei partecipanti
                                            foreach (range(1, $item->participants) as $participant) {
                                                generateTicket($order);
                                            }
                                        }
                                    }

                                }),
                                'online' => call_user_func(function () use ($item, $product) {
                                    // TODO: Pagamento online
                                    // Se andato a buon fine, creo l'ordine
                                    $services = Service::whereIn('id', json_decode($item->services))->get();
                                    $data = [
                                        'booking' => [
                                            'date' => $item->time->date,
                                            'time' => $item->time->time,
                                            'time_id' => $item->time->id,
                                            'duration' => $product->duration,
                                            'participants' => [
                                                'total' => $item->participants,
                                                'adults' => $item->adults,
                                                'kids' => $item->kids,
                                                'children' => $item->children,
                                            ],
                                            'services' => $services,
                                            'total' => $item->total_price,
                                        ],
                                        'product' => [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'destination' => $product->destination->name,
                                            'category' => $product->category->name,
                                            'typology' => $product->typology->name,
                                        ],
                                    ];

                                    if ($item->product->isRental()) {
                                        // Aumento il contatore "sold"
                                        $item->time->increment('sold');
                                        // Riduco il contatore "booked";
                                        $item->time->decrement('booked');
                                    } else {
                                        // Aumento il contatore "sold"
                                        $item->time->increment('sold', $item->participants);
                                        // Riduco il contatore "booked";
                                        $item->time->decrement('booked', $item->participants);
                                    }
                                    // Creo l'ordine
                                    $order = auth()->user()->orders()->create([
                                        'uuid' => strtoupper(Str::random()),
                                        'cart_id' => $this->cart->id,
                                        'partner_id' => $product->user_id,
                                        'data' => $data,
                                        'payment_method' => 'online',
                                        'payment_status' => 'paid', // TODO: inserire esito del pagamento ("unpaid" oppure "paid")
                                        'paid_at' => now(), // TODO: inseire timestamp dell'avvenuto pagamento
                                        'total' => $item->showPriceAfterDiscount(),
                                        'used_balance' => $item->to_pay,
                                        'coupon' => $item->coupon ?? null,
                                        'status' => $product->booking_type === 'direct' ? 'approved' : 'to_approve',
                                        'approval_deadline' => $item->is_gift ? null : now()->addHours(env('APPROVAL_DEADLINE_HOURS', 24)),
                                        'is_gift' => $item->gift,
                                        'gift_from' => $item->is_gift ? auth()->id() : null,
                                        'gift_data' => $item->is_gift ? [
                                            'receiver_name' => $item->receiver_name,
                                            'receiver_email' => $item->receiver_email,
                                            'receiver_message' => $item->receiver_message,
                                        ] : null,
                                        'redeem_code' => $item->gift ? strtoupper(Str::random(10)) : null
                                    ]);

                                    logger("Ordine {$order->uuid}: pagare {$item->to_pay}€ al B2B '{$item->product->user->fullname}'");

                                    // Riduco saldo account
                                    auth()->user()->removeBalance($item->to_pay);

                                    if ($order) {
                                        // Controllo se l'esperienza acquistata è un noleggio
                                        if ($item->product->isRental()) {
                                            // Se è un noleggio, genero un solo Ticket
                                            generateTicket($order);
                                        } else {
                                            // Se non è un noleggio, genero tanti Ticket quanto il numero dei partecipanti
                                            foreach (range(1, $item->participants) as $participant) {
                                                generateTicket($order);
                                            }
                                        }
                                    }
                                })
                            };
                            if ($item->coupon) {
                                Coupon::where('code', $item->coupon['code'])->first()->update([
                                    'used' => true,
                                ]);
                            }
                        } else {
                            dd('STOP: Prodotto senza metodo di pagamento!');
                        }
                    }),
                    'gift-card' => call_user_func(function () use ($item) {
                        $gift_card_user = GiftCardUser::create([
                            'gift_card_id' => $item->gift_card->id,
                            'gift_from' => auth()->id(),
                            'redeem_code' => strtoupper(Str::random(10)),
                            'activation_deadline' => Carbon::now()->addYear()
                        ]);
                        // Invio email con i dati della gift card
                        Mail::to($item->receiver_email)->send(new SendGiftCard($gift_card_user));
                    })
                };
            }

            // Carrello temporaneo per dati allo step 3
            // Cancello il carrello e i suoi items
            $this->cart->items()->delete();
            $this->cart->delete();
        }
    }

    public function prev()
    {
        $this->currentStep--;
    }

    public function downloadQrCode(Order $order)
    {
        dd("Download biglietti per l'ordine '{$order->uuid}'");
    }

    #[On('user-logged-in')]
    public function userLoggedIn()
    {
        $this->setCart();
        $this->dispatch('$refresh');
    }

    public function applyCoupon()
    {
        $this->resetErrorBag();

        $coupon = Coupon::where('code', $this->coupon_code)
            ->whereIn('product_id', $this->cart->items->pluck('product_id')->toArray())
            ->whereDate('date_start', '<=', now()->format('Y-m-d'))
            ->whereDate('date_end', '>=', now()->format('Y-m-d'))
            ->where('used', false)
            ->first();

        if (!$coupon) {
            $this->addError('coupon_code', 'Non è possibile applicare il coupon.');

            return;
        } else {
            if (now()->format('Y-m-d') > $coupon->date_end) {
                $this->addError('coupon_code', 'Il coupon è scaduto.');

                return;
            }
        }

        $item = $this->cart->items->where('product_id', $coupon->product_id)->first();
        $item->update([
            'coupon' => [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->percentage ?? $coupon->value,
            ],
        ]);

        $this->coupon = $coupon;

        $this->dispatch('coupon-applied');
        $this->reset('coupon_code');
    }

    #[On('coupon-removed')]
    #[On('coupon-applied')]
    public function render()
    {
        return view('livewire.guest.pages.checkout', [
            'countries' => Country::all(),
        ]);
    }
}
