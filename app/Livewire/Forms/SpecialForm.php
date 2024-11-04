<?php

namespace App\Livewire\Forms;

use App\Models\Special;
use Carbon\Carbon;
use Livewire\Form;

class SpecialForm extends Form
{
    public ?Special $special;

    public $current_prices = null;

    public $name = '';

    public $dates = [];

    public $adults_price = null;

    public $kids_price = null;

    public $children_price = null;

    public $rental_total_price = null;

    public $product_id = null;

    public $typology_id = null;

    public $types = [
        'percentage' => 'Percentuale',
        'cash' => 'Importo',
    ];

    public $type = null;

    public $percentage = null;

    public function setSpecial(?Special $special)
    {
        if ($special) {
            $this->special = $special;

            $product = $special->product ? $special->product : null;

            $this->product_id = $product ? $special->product->id : null;
            $this->typology_id = $product ? $product->typology_id : null;

            $this->name = $special->name;
            $this->type = $special->type;
            $this->percentage = $special->percentage;
            $this->adults_price = $special->adults_price;
            $this->kids_price = $special->kids_price;
            $this->children_price = $special->children_price;
            $this->rental_total_price = $special->rental_total_price;
            if ($special->date_start && $special->date_end) {
                $this->dates = [
                    Carbon::parse($special->date_start)->startOfDay()->format('d/m/Y'),
                    Carbon::parse($special->date_end)->startOfDay()->format('d/m/Y'),
                ];
            }
        } else {
            $this->special = new Special();
        }
    }

    public function submit()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'type' => 'required|in:percentage,cash',
            'percentage' => $this->type === 'percentage' ? 'required|numeric|between:0,100' : 'nullable',
            'adults_price' => $this->typology_id !== 6 && $this->type === 'cash' ? 'required' : 'nullable',
            'kids_price' => $this->typology_id !== 6 && $this->type === 'cash' ? 'required' : 'nullable',
            'children_price' => $this->typology_id !== 6 && $this->type === 'cash' ? 'required' : 'nullable',
            'rental_total_price' => $this->typology_id === 6 && $this->type === 'cash' ? 'required' : 'nullable',
            'dates' => 'required|array',
        ]);

        $date_start = Carbon::createFromFormat('d/m/Y', $this->dates[0])->startOfDay();
        $date_end = Carbon::createFromFormat('d/m/Y', $this->dates[1])->startOfDay();
        $this->special->update([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'type' => $this->type,
            'percentage' => $this->percentage,
            'product_id' => $this->product_id,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'adults_price' => $this->adults_price,
            'kids_price' => $this->kids_price,
            'children_price' => $this->children_price,
            'rental_total_price' => $this->rental_total_price,
        ]);
    }
}
