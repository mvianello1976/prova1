<?php

namespace App\Livewire\Partner\Pages\Availability\Modals;

use App\Livewire\Partner\Pages\Availability\Show;
use App\Models\Availability;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use LivewireUI\Modal\ModalComponent;

class AddAvailability extends ModalComponent
{
    public Availability $availability;

    public $dates = [];

    public $disabledDates = [];

    public $time_start = null;

    public $time_end = null;

    public $step = null;

    public $vehicles_per_slot = null;

    public $participants_per_vehicle = null;

    public $adults_price = null;

    public $kids_price = null;

    public $children_price = null;

    public $rental_total_price = null;

    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                $availability_dates = [];
                foreach ($this->availability->dates as $date) {
                    $availability_dates[] = [
                        'adults_price' => $date->adults_price,
                        'kids_price' => $date->kids_price,
                        'children_price' => $date->children_price,
                        'dates' => [
                            Carbon::parse($date->date_start)->format('d/m/Y'),
                            Carbon::parse($date->date_end)->format('d/m/Y'),
                        ],
                        'time_start' => Carbon::createFromTimeString($date->time_start)->format('H:i'),
                        'time_end' => Carbon::createFromTimeString($date->time_end)->format('H:i'),
                        'step' => $date->step,
                        'vehicles_per_slot' => $date->vehicles_per_slot,
                        'participants_per_vehicle' => $date->participants_per_vehicle,
                        'rental_total_price' => $date->rental_total_price,
                    ];
                }
                $availability_dates[] = [
                    'adults_price' => $this->adults_price ?? null,
                    'kids_price' => $this->kids_price ?? null,
                    'children_price' => $this->children_price ?? null,
                    'dates' => [
                        isset($this->dates[0]) ? Carbon::createFromFormat('d/m/Y', $this->dates[0])->startOfDay()->format('d/m/Y') : null,
                        isset($this->dates[1]) ? Carbon::createFromFormat('d/m/Y', $this->dates[1])->startOfDay()->format('d/m/Y') : null,
                    ],
                    'time_start' => $this->time_start,
                    'time_end' => $this->time_end,
                    'step' => $this->step,
                    'vehicles_per_slot' => $this->vehicles_per_slot,
                    'participants_per_vehicle' => $this->participants_per_vehicle,
                    'rental_total_price' => $this->rental_total_price,
                ];

                $check = $this->availability->checkOverlap($availability_dates);
                if ($check) {
                    $validator->errors()->add('overlap', __('Sovrapposizione orari: controllare!'));
                }
            });
        });
    }

    public function mount()
    {
        $this->disabledDates = $this->availability->times->pluck('date');
    }

    public function submit()
    {
        $this->validate([
            'dates' => 'required|array',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'step' => 'required',
            'vehicles_per_slot' => ! $this->availability->product->isRental() ? 'nullable' : 'required',
            'participants_per_vehicle' => ! $this->availability->product->isRental() ? 'nullable' : 'required',
            'adults_price' => ! $this->availability->product->isRental() ? 'required' : 'nullable',
            'kids_price' => ! $this->availability->product->isRental() ? 'required' : 'nullable',
            'children_price' => ! $this->availability->product->isRental() ? 'required' : 'nullable',
            'rental_total_price' => ! $this->availability->product->isRental() ? 'nullable' : 'required|numeric',
        ]);
        // Creazione dates
        $date_start = Carbon::createFromFormat('d/m/Y', $this->dates[0])->startOfDay();
        $date_end = Carbon::createFromFormat('d/m/Y', $this->dates[1])->startOfDay();
        $d = $this->availability->dates()->create([
            'adults_price' => $this->adults_price ?? null,
            'kids_price' => $this->kids_price ?? null,
            'children_price' => $this->children_price ?? null,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'step' => $this->step,
            'vehicles_per_slot' => $this->vehicles_per_slot,
            'participants_per_vehicle' => $this->participants_per_vehicle,
            'rental_total_price' => $this->rental_total_price,
        ]);

        // Creazione times
        $date_period = CarbonPeriod::create($d->date_start, '1 day', $d->date_end);
        foreach ($date_period as $date) {
            $time_period = CarbonPeriod::create($d->time_start, "{$d->step} minutes", $d->time_end);
            foreach ($time_period as $time) {
                $d->times()->create([
                    'date' => $date->format('Y-m-d'),
                    'time' => $time->format('H:i'),
                    'max' => $d->availability->participants ?? $d->vehicles_per_slot,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('availability_added')->to(Show::class);
    }

    public function render()
    {
        return view('livewire.partner.pages.availability.modals.add-availability');
    }
}
