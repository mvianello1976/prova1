<?php

namespace App\Livewire\Partner\Pages\Availability\Modals;

use App\Livewire\Forms\EditAvailabilityDateForm;
use App\Models\AvailabilityDate;
use LivewireUI\Modal\ModalComponent;

class EditAvailability extends ModalComponent
{
    public AvailabilityDate $availability_date;

    public EditAvailabilityDateForm $form;

    public function mount()
    {
        $this->form->setAvailabilityDate($this->availability_date);
    }

    public function submit($force = false)
    {
        $this->form->submit($force);
    }

    public function render()
    {
        return view('livewire.partner.pages.availability.modals.edit-availability');
    }
}
