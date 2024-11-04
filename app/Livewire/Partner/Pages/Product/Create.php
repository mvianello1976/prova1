<?php

namespace App\Livewire\Partner\Pages\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Product;
use App\Models\Typology;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public Product $product;

    public ProductForm $form;

    public function mount()
    {
        $this->form->setProduct($this->product);
    }

    public function addFaq()
    {
        $this->form->addFaq();
    }

    public function removeFaq($index)
    {
        $this->form->removeFaq($index);
    }

    public function updateIncludedService($type, $item)
    {
        $this->form->updateIncludedService($type, $item);
    }

    public function updateExtraService($type, $item)
    {
        $this->form->updateExtraService($type, $item);
    }

    #[On('place-chosen')]
    public function setDestination($types, $address)
    {
        match ($types[0]) {
            'locality' => call_user_func(function () use ($address) {
                $destination = Destination::where('name', $address['city'])
                    ->where('province', $address['province'])
                    ->where('country', $address['country'])
                    ->first();
                if (! $destination) {
                    $destination = Destination::create([
                        'name' => $address['city'],
                        'slug' => Str::slug($address['city']),
                        'province' => $address['province'],
                        'country' => $address['country'],
                        'latitude' => $address['lat'],
                        'longitude' => $address['lng'],
                    ]);
                }
                $this->form->destination_id = $destination->id;
            }),
            'address' => call_user_func(function () use ($address) {
                $this->form->meeting_point = "{$address['city']}, {$address['province']}";
                $this->form->meeting_point_coords = [
                    $address['lat'],
                    $address['lng'],
                ];
            })
        };
    }

    public function deleteImage($id)
    {
        $image = $this->product->images()->findOrFail($id);
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }

    public function saveAndExit()
    {
        $this->form->submit();

        return redirect()->route('dashboard');
    }

    public function returnToReview()
    {
        $this->form->submit();

        $this->form->product->update([
            'temporary_step' => null,
        ]);

        return redirect()->route('product.create', $this->product);
    }

    public function prev()
    {
        $this->form->product->decrement('current_step');
    }

    public function next()
    {
        $this->form->submit();

        if ($this->product->current_step === 13) {
            return redirect()->route('product.index');
        }

        $this->form->product->increment('current_step');
    }

    public function setTemporaryStep($step)
    {
        $this->form->product->update([
            'temporary_step' => $step,
        ]);
    }

    public function render()
    {
        return view('livewire.partner.pages.product.create', [
            'categories' => Category::all(),
            'typologies' => Typology::all(),
        ]);
    }
}
