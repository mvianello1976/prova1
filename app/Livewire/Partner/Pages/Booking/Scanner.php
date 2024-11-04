<?php

namespace App\Livewire\Partner\Pages\Booking;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

use function App\Helpers\decrypt_data;

#[Layout('layouts.app')]
class Scanner extends Component
{
    public $code = null;

    #[On('scanned')]
    public function scanned($data)
    {
        if ($data) {
            $this->code = $data['data'];
        } else {
            $this->code = null;
        }
    }

    #[On('confirm')]
    public function confirm($code = null)
    {
        $this->code = $code;
        if ($this->code !== null) {
            // Controllo Codice biglietto
            $ticket_data = json_decode(decrypt_data($this->code));
            $order = Order::where('uuid', $ticket_data->order_uuid)->firstOrFail();
            $ticket = Ticket::where('uuid', $ticket_data->ticket_uuid)->firstOrFail();
            $client = User::findOrFail($ticket_data->user_id);
            $partner = User::findOrFail($ticket_data->partner_id);

            $order_date = Carbon::createFromFormat('Y-m-d', $order->data['booking']['date'])->startOfDay();

            // Verifico che il partner che sta scansionando il biglietto sia il proprietario dell'esperienza associata al biglietto
            if (! $partner->is(auth()->user())) {
                dd('Non sei autorizzato a validare questo biglietto.');
            }

            // Verifico che l'ordine esista
            if (! $order) {
                dd('L\'ordine associato a questo biglietto non esiste.');
            }

            // Verifico che il biglietto esista
            if (! $ticket) {
                dd('Il biglietto associato a questo codice non esiste.');
            }

            // Verifico se il biglietto è di un evento passato
            if ($order_date->lt(now()->startOfDay()->format('Y-m-d'))) {
                dd("Il Ticket si riferisce ad un'esperienza passata.");
            }

            // Verifico se il biglietto è di un evento futuro
            if ($order_date->gt(now()->startOfDay()->format('Y-m-d'))) {
                dd("Il Ticket si riferisce ad un'esperienza futura, si prega di riprovare il ".$order_date->format('d-m-Y'));
            }

            // Verifico che il biglietto non sia già stato validato
            if ($ticket->validated_at) {
                dd("Il biglietto è già stato validato il {$ticket->validated_at->format('d/m/Y H:i:s')}.", [
                    $order->data,
                ]);
            }

            // Se tutto è andato a buon fine e il biglietto non è stato ancora validato, eseguo la validazione
            $ticket->update([
                'validated' => true,
                'validated_at' => now(),
            ]);

            dd('Il biglietto è stato validato con successo.');
        }
    }

    public function render()
    {
        return view('livewire.partner.pages.booking.scanner');
    }
}
