<?php

namespace App\Livewire\Forms;

use App\Models\Availability;
use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Form;

class AvailabilityForm extends Form
{
    public ?Availability $availability;

    public ?Product $product;

    public $availability_dates = [];

    public $product_id = null;

    public $typology_id = null;

    public $participants = null;

    public $vehicles = null;

    public function setAvailability(?Availability $availability)
    {
        if ($availability) {
            $this->availability = $availability;

            $product = $availability->product ? $availability->product : null;

            $this->product_id = $product ? $availability->product->id : null;
            $this->typology_id = $product ? $availability->product->typology_id : null;
            $this->participants = $availability->participants;
            $this->vehicles = $availability->vehicles;
            $this->adults_price = $availability->adults_price;
            $this->children_price = $availability->children_price;
            $this->kids_price = $availability->kids_price;
            $this->availability_dates = [];
            foreach ($availability->dates as $item) {
                $this->availability_dates[] = [
                    'adults_price' => $item->adults_price,
                    'kids_price' => $item->kids_price,
                    'children_price' => $item->children_price,
                    'dates' => [
                        Carbon::parse($item->date_start)->format('d/m/Y'),
                        Carbon::parse($item->date_end)->format('d/m/Y'),
                    ],
                    'time_start' => Carbon::createFromTimeString($item->time_start),
                    'time_end' => Carbon::createFromTimeString($item->time_end),
                    'step' => $item->step,
                    'vehicles_per_slot' => $item->vehicles_per_slot,
                    'participants_per_vehicle' => $item->participants_per_vehicle,
                    'rental_total_price' => $item->rental_total_price,
                ];
            }
        } else {
            $this->availability = new Availability();
        }
    }

    public function addAvailabilityDates()
    {
        $this->availability_dates[] = [
            'adults_price' => null,
            'kids_price' => null,
            'children_price' => null,
            'dates' => [],
            'time_start' => null,
            'time_end' => null,
            'step' => null,
            'vehicles_per_slot' => null,
            'participants_per_vehicle' => null,
            'rental_total_price' => null,
        ];
    }

    public function removeAvailabilityDate($index)
    {
        unset($this->availability_dates[$index]);

        $this->availability_dates = array_values($this->availability_dates);
    }

    public function submit()
    {
        match ($this->availability->current_step) {
            null => call_user_func(function () {
                $this->validation();
                $this->availability->update([
                    'product_id' => $this->product_id,
                    'participants' => $this->participants,
                    'current_step' => 1,
                ]);
            }),
            1 => call_user_func(function () {
                $this->validation(1);
            }),
            2 => call_user_func(function () {
                $this->validation(2);
                foreach ($this->availability_dates as $availability_date) {
                    // Creazione dates
                    $date_start = Carbon::createFromFormat('d/m/Y', $availability_date['dates'][0]);
                    $date_end = Carbon::createFromFormat('d/m/Y', $availability_date['dates'][1]);
                    $d = $this->availability->dates()->create([
                        'adults_price' => $availability_date['adults_price'] ?? null,
                        'kids_price' => $availability_date['kids_price'] ?? null,
                        'children_price' => $availability_date['children_price'] ?? null,
                        'date_start' => $date_start,
                        'date_end' => $date_end,
                        'time_start' => $availability_date['time_start'],
                        'time_end' => $availability_date['time_end'],
                        'step' => $availability_date['step'],
                        'vehicles_per_slot' => $availability_date['vehicles_per_slot'],
                        'participants_per_vehicle' => $availability_date['participants_per_vehicle'],
                        'rental_total_price' => $availability_date['rental_total_price'],
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
                }
            }),
            //            default => call_user_func(function () {
            //                $validated = $this->validation($this->availability->current_step);
            //                $this->availability->update($validated);
            //            })
        };
    }

    protected function validation($step = null)
    {
        return match ($step) {
            null => $this->validate([
                'product_id' => 'required|exists:products,id',
                'participants' => $this->typology_id !== 6 ? 'required' : 'nullable',
            ]),
            1 => $this->validate([
                'availability_dates.*.dates' => 'required|array',
                'availability_dates.*.time_start' => 'required',
                'availability_dates.*.time_end' => 'required|after:availability_dates.*.time_start',
                'availability_dates.*.step' => 'required',
                'availability_dates.*.vehicles_per_slot' => $this->typology_id !== 6 ? 'nullable' : 'required',
                'availability_dates.*.participants_per_vehicle' => $this->typology_id !== 6 ? 'nullable' : 'required',
            ]),
            2 => $this->validate([
                'availability_dates.*.adults_price' => $this->typology_id !== 6 ? 'required' : 'nullable',
                'availability_dates.*.kids_price' => $this->typology_id !== 6 ? 'required' : 'nullable',
                'availability_dates.*.children_price' => $this->typology_id !== 6 ? 'required' : 'nullable',
                'availability_dates.*.rental_total_price' => $this->typology_id !== 6 ? 'nullable' : 'required|numeric',
            ])
        };
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                $check = $this->availability->checkOverlap($this->availability_dates);
                if ($check) {
                    $validator->errors()->add('overlap', __('Sovrapposizione orari: controllare!'));
                }
            });
        });
    }
}
