<?php

namespace App\Livewire\Partner\Modals;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class Insurance extends ModalComponent
{
    public $registration_number = '';

    public $liability_insurance = [];

    public function mount()
    {
        $this->registration_number = auth()->user()->informations->registration_number;
    }

    public function submit()
    {
        auth()->user()->informations()->update([
            'registration_number' => $this->registration_number,
        ]);
        if ($this->liability_insurance) {
            foreach ($this->liability_insurance as $item) {
                $path = Storage::disk('public')->put('partners/'.auth()->id().'/liability_insurance', new File($item['path']));
                auth()->user()->informations()->update([
                    'liability_insurance' => $path,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('partner-missing-data-updated');
    }

    public function render()
    {
        return view('livewire.partner.modals.insurance');
    }
}
