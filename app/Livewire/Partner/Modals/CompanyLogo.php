<?php

namespace App\Livewire\Partner\Modals;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class CompanyLogo extends ModalComponent
{
    public $company_logo = [];

    public function submit()
    {
        if ($this->company_logo) {
            if (auth()->user()->informations->company_logo) {
                Storage::disk('public')->delete(auth()->user()->informations->company_logo);
            }
            foreach ($this->company_logo as $item) {
                $path = Storage::disk('public')->put('partners/'.auth()->id().'/company_logo', new File($item['path']));
                auth()->user()->informations()->update([
                    'company_logo' => $path,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('partner-missing-data-updated');
        $this->dispatch('partner-data-updated');
    }

    public function render()
    {
        return view('livewire.partner.modals.company-logo');
    }
}
