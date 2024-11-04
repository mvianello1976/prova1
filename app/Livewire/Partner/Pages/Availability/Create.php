<?php

namespace App\Livewire\Partner\Pages\Availability;

use App\Livewire\Forms\AvailabilityForm;
use App\Models\Availability;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public Availability $availability;

    public AvailabilityForm $form;

    public $steps = [
        1 => 'Date',
        2 => 'Prezzi',
        3 => 'Fine',
    ];

    public $currentStep = null;

    public function mount()
    {
        $this->form->setAvailability($this->availability);
        $this->currentStep = $this->availability->current_step;
        if (! $this->form->availability_dates) {
            $this->addAvailabilityDates();
        }
    }

    public function addAvailabilityDates()
    {
        $this->form->addAvailabilityDates();
    }

    public function updatedFormProductId()
    {
        $product = Product::find($this->form->product_id);
        $this->form->typology_id = $product->typology_id;
        $this->form->participants = null;
    }

    public function removeAvailabilityDate($index)
    {
        $this->form->removeAvailabilityDate($index);
    }

    #[On('delete-availability')]
    public function cancel()
    {
        $this->availability->delete();

        return redirect()->route('availabilities.index');
    }

    public function next()
    {
        $this->form->submit();

        if ($this->availability->current_step) {
            $this->form->availability->increment('current_step');
        }
    }

    public function render()
    {
        return view('livewire.partner.pages.availability.create', [
            'products' => auth()->user()->products()->published()->get(),
            'participants' => [
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10,
            ],
        ]);
    }
}
