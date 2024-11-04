<?php

namespace App\Livewire\Partner\Pages\Specials;

use App\Livewire\Forms\SpecialForm;
use App\Models\Product;
use App\Models\Special;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public Special $special;

    public SpecialForm $form;

    public $steps = [
        1 => 'Prodotto',
        2 => 'Validità',
        3 => 'Offerta',
    ];

    public $currentStep = null;

    public function mount()
    {
        $this->form->setSpecial($this->special);
    }

    public function updatedFormProductId()
    {
        $product = Product::find($this->form->product_id);
        $this->form->typology_id = $product->typology_id ?? null;
        $this->form->percentage = null;
        $this->form->adults_price = null;
        $this->form->kids_price = null;
        $this->form->children_price = null;
        $this->form->rental_total_price = null;
        $this->check();
    }

    public function check()
    {
        $this->form->resetErrorBag();
        $product = Product::find($this->form->product_id);

        if ($this->form->dates) {
            $date_start = \Carbon\Carbon::createFromFormat('d/m/Y', $this->form->dates[0])->format('Y-m-d');
            $date_end = \Carbon\Carbon::createFromFormat('d/m/Y', $this->form->dates[1])->format('Y-m-d');

            $overlappingSpecialOffers = Special::where('product_id', $product->id)
                ->where(function ($query) use ($date_start, $date_end) {
                    $query->whereBetween('date_start', [$date_start, $date_end])
                        ->orWhereBetween('date_end', [$date_start, $date_end])
                        ->orWhere(function ($query) use ($date_start, $date_end) {
                            $query->where('date_start', '<', $date_start)
                                ->where('date_end', '>', $date_end);
                        });
                })
                ->count();

            if ($overlappingSpecialOffers) {
                $this->form->addError('overlap', 'Attenzione: Esiste già un\'offerta per questo periodo!');

                return;
            }

            $cp = $product->availabilities()->whereHas('dates', function ($q) use ($date_start, $date_end) {
                if ($this->form->dates) {
                    $q->where(function($query) use ($date_start, $date_end) {
                        $query->where(function($query) use ($date_start, $date_end) {
                            $query->where('date_start', '<=', $date_start)
                                ->where('date_end', '>=', $date_end);
                        })->orWhere(function($query) use ($date_start, $date_end) {
                            $query->whereBetween('date_start', [$date_start, $date_end])
                                ->orWhereBetween('date_end', [$date_start, $date_end]);
                        });
                    });
                }
            })->with(['dates' => function ($query) use ($date_start, $date_end) {
                $query->where(function($query) use ($date_start, $date_end) {
                    $query->where(function($query) use ($date_start, $date_end) {
                        $query->where('date_start', '<=', $date_start)
                            ->where('date_end', '>=', $date_end);
                    })->orWhere(function($query) use ($date_start, $date_end) {
                        $query->whereBetween('date_start', [$date_start, $date_end])
                            ->orWhereBetween('date_end', [$date_start, $date_end]);
                    });
                });
            }])->first();
            $this->form->current_prices = $cp?->dates->first() ?? null;
        }
    }

    public function updatedFormType()
    {
        $this->form->percentage = null;
        $this->form->adults_price = null;
        $this->form->kids_price = null;
        $this->form->children_price = null;
        $this->form->rental_total_price = null;
        $this->check();
    }

    public function updatedFormDates()
    {
        $this->check();
    }

    #[On('delete-special')]
    public function cancel()
    {
        $this->special->delete();

        return redirect()->route('specials.index');
    }

    public function next()
    {
        $this->form->submit();

        return redirect()->route('specials.index');
    }

    public function render()
    {
        return view('livewire.partner.pages.specials.create', [
            'products' => auth()->user()->products()->published()->get(),
        ]);
    }
}
