<?php

namespace App\Livewire\Partner\Pages\Coupons;

use App\Livewire\Forms\CouponForm;
use App\Models\Coupon;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public Coupon $coupon;

    public CouponForm $form;

    public $steps = [
        1 => 'Prodotto',
        2 => 'Validità',
        3 => 'Offerta',
    ];

    public $currentStep = null;

    public function mount()
    {
        $this->form->setCoupon($this->coupon);
    }

    public function updatedFormProductId()
    {
        $product = Product::find($this->form->product_id);
        $this->form->typology_id = $product->typology_id ?? null;
        $this->form->value = null;
        $this->check();
    }

    public function check()
    {
        $this->form->resetErrorBag();
        $product = Product::find($this->form->product_id);

        if ($this->form->dates) {
            $date_start = \Carbon\Carbon::createFromFormat('d/m/Y', $this->form->dates[0])->format('Y-m-d');
            $date_end = \Carbon\Carbon::createFromFormat('d/m/Y', $this->form->dates[1])->format('Y-m-d');

            $overlappingCoupons = Coupon::where('product_id', $product->id)
                ->where(function ($query) use ($date_start, $date_end) {
                    $query->whereBetween('date_start', [$date_start, $date_end])
                        ->orWhereBetween('date_end', [$date_start, $date_end])
                        ->orWhere(function ($query) use ($date_start, $date_end) {
                            $query->where('date_start', '<', $date_start)
                                ->where('date_end', '>', $date_end);
                        });
                })
                ->count();

            if ($overlappingCoupons) {
                $this->form->addError('overlap', 'Attenzione: Esiste già un coupon per questo periodo!');

                return;
            }
        }
    }

    public function updatedFormCode($value)
    {
        $this->form->code = strtoupper($value);
    }

    public function updatedFormType()
    {
        $this->form->percentage = null;
        $this->form->value = null;
        $this->check();
    }

    public function updatedFormDates()
    {
        $this->check();
    }

    #[On('delete-coupon')]
    public function cancel()
    {
        $this->coupon->delete();

        return redirect()->route('coupons.index');
    }

    public function next()
    {
        $this->form->submit();

        return redirect()->route('coupons.index');
    }

    public function render()
    {
        return view('livewire.partner.pages.coupons.create', [
            'products' => auth()->user()->products()->published()->get(),
        ]);
    }
}
