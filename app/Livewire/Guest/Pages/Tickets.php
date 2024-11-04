<?php

namespace App\Livewire\Guest\Pages;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Browsershot\Browsershot;

#[Layout('layouts.guest')]
class Tickets extends Component
{
    public Order $order;

    public function mount()
    {
        if (! $this->order->user->is(auth()->user())) {
            return abort(403, __('Non sei autorizzato ad accedere a questa pagina.'));
        }
    }

    public function download()
    {
        $filename = "{$this->order->uuid}.pdf";

        $html = view('pdf.tickets', [
            'order' => $this->order,
        ])->render();

        Browsershot::html($html)
            ->paperSize(210, 297)
            ->margins(3, 3, 3, 3)
            ->showBackground()
            ->savePdf($filename);


        return response()->download($filename)->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.guest.pages.tickets');
    }
}
