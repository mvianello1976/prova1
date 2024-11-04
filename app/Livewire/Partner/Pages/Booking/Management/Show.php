<?php

namespace App\Livewire\Partner\Pages\Booking\Management;

use App\Models\AvailabilityTime;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ticket;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use function App\Helpers\generateTicket;
use function Pest\Laravel\get;

#[Layout('layouts.app')]
class Show extends Component
{
    public Order $order;

    public function changeOrderStatus()
    {
        match ($this->order->status) {
            'to_approve' => call_user_func(function () {
                $this->order->update([
                    'status' => 'approved',
                ]);
                // TODO: Invio email di conferma approvazione
            }),
            default => null
        };
    }

    public function setPaymentType()
    {
        $this->order->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function print()
    {
        dd('Stampa');
    }

    #[On('update-order')]
    public function updateOrder(Order $order, $time_id, $adults, $kids, $children)
    {
        $old_order = $order->replicate();
        $old_availability_time = AvailabilityTime::find($old_order->data['booking']['time_id']);
        $new_availability_time = AvailabilityTime::find($time_id);
        $product = Product::find($order->data['product']['id']);

        $participants = $adults + $kids + $children;
        $order->update([
            'data->booking->date' => $new_availability_time->date,
            'data->booking->time' => $new_availability_time->time,
            'data->booking->time_id' => $new_availability_time->id,
            'data->booking->participants->adults' => $adults,
            'data->booking->participants->kids' => $kids,
            'data->booking->participants->children' => $children,
            'data->booking->participants->total' => $participants,
        ]);

        $order->update([
            'data->booking->total' => $order->total_price,
            'total' => $order->showPriceAfterDiscount()
        ]);

        // Decremento vecchio "sold" e incremento nuovo "sold"
        $old_availability_time->decrement('sold', $old_order->data['booking']['participants']['total']);
        $new_availability_time->increment('sold', $participants);

        // Cancello vecchi tickets
        $old_tickets = Ticket::where('order_id', $order->id)->get();
        foreach ($old_tickets as $ticket) {
            $ticket->delete();
        }

        // Controllo se l'esperienza acquistata è un noleggio
        if ($product->isRental()) {
            // Se è un noleggio, genero un solo Ticket
            generateTicket($order);
        } else {
            // Se non è un noleggio, genero tanti Ticket quanto il numero dei partecipanti
            foreach (range(1, $participants) as $participant) {
                generateTicket($order);
            }
        }

        $this->dispatch('order-updated')->to('partner.modals.edit-order');
        $this->dispatch('order-updated')->self();
    }

    #[On('order-canceled')]
    #[On('order-updated')]
    public function render()
    {
        return view('livewire.partner.pages.booking.management.show');
    }
}
