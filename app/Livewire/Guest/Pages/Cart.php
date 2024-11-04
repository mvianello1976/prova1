<?php

namespace App\Livewire\Guest\Pages;

use App\Models\AvailabilityTime;
use App\Models\CartItem;
use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.guest')]
class Cart extends Component
{
    public $cart = null;

    public $coupon_code = null;

    public $coupon = null;

    public function mount()
    {
        $this->cart = auth()->user()->cart ?? \App\Models\Cart::where('user_id', session('guest_id'))->first();
    }

    #[On('extra-services-edited')]
    public function extraServicesEdited()
    {
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
                'value' => $coupon->value,
            ],
        ]);

        $this->coupon = $coupon;

        $this->reset('coupon_code');
    }

    public function removeCoupon(CartItem $cartItem)
    {
        $cartItem->update([
            'coupon' => null,
        ]);
    }

    #[On('update-cart-item')]
    public function updateCartItem(CartItem $cart_item, $time_id, $adults, $kids, $children)
    {
        $old_cart_item = $cart_item->replicate();
        // Duplicare prenotazione con nuovi dati
        $cart_item->update([
            'availability_time_id' => $time_id,
            'adults' => $adults,
            'kids' => $kids,
            'children' => $children,
        ]);

        // Decremento "booked" da vecchia prenotazione
        if (!$cart_item->product->isRental()) {
            $old_cart_item->time->decrement('booked', $old_cart_item->participants);
            $cart_item->time->increment('booked', $cart_item->participants);
        } else {
            $old_cart_item->time->decrement('booked');
            $cart_item->time->increment('booked');
        }

        $this->dispatch('cart-item-updated')->to('guest.modals.edit-cart-item');
    }

    public function goToCheckout()
    {
        $check = true;
        // Verifico se la data e l'orario dell'evento nel carrello sono passati rispetto all'orario attuale
        foreach ($this->cart->items as $item) {
            if ($item->gift && (!$item->receiver_name || !$item->receiver_email)) {
                $this->addError('gift_data_missing', __('Per proseguire è necessario compilare i dati degli articoli in regalo.'));
                return false;
            }

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

        if ($check) {
            return redirect()->route('guest.checkout');
        }
    }

    public function delete($id)
    {
        $cart_item = CartItem::find($id);

        if ($cart_item->type == 'product') {
            $availability_time = AvailabilityTime::find($cart_item->availability_time_id);
            if ($cart_item->product->isRental()) {
                $availability_time->decrement('booked');
            } else {
                $availability_time->decrement('booked', $cart_item->participants);
            }
        }

        $cart_item->delete();

        if ($this->cart->items->count() === 0) {
            $this->cart->delete();

            return redirect()->route('guest.index');
        }
        $this->dispatch('$refresh');
        $this->dispatch('removed-from-cart');
    }

    #[On('cart-item-updated')]
    public function render()
    {
        if ($this->cart) {
            foreach ($this->cart->items as $item) {
                $item->update([
                    'to_pay' => $this->cart->splitPayment($item)
                ]);
            }
        }
        return view('livewire.guest.pages.cart');
    }
}
