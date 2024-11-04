<?php

namespace App\Livewire\Forms;

use App\Models\Destination;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product;

    // Step 1
    public $category_id = null;

    // Step 2
    public $typology_id = null;

    // Step 3
    public $name = '';

    // Step 4
    public $description = '';

    public $cancellation = null;

    public $duration = null;

    public $difficulty = null;

    public $pets_allowed = null;

    public $accessibility = null;

    public $reception_staff = [];

    // Step 5
    public ?Destination $destination;

    public $destination_id = null;

    public $meeting_point = '';

    public $meeting_point_coords = [];

    // Step 6
    public $keywords = [];

    // Step 7
    public $incl_services = [];

    // Step 8
    public $extr_services = [];

    // Step 9
    public $not_suitable = [];

    public $not_allowed = [];

    public $mandatory_items = [];

    public $preliminary_informations = '';

    public $faqs = [];

    public $contact = '';

    // Step 10
    public $uploaded_images = [];

    public $images = [];

    // Step 11
    public $booking_type = null;

    // Step 12
    public $payment_type = null;

    public function setProduct(?Product $product)
    {
        if ($product) {
            $this->product = $product;

            // Step 1
            $this->category_id = $product->category_id;
            // Step 2
            $this->typology_id = $product->typology_id;
            // Step 3
            $this->name = $product->name;
            // Step 4
            $this->description = $product->description;
            $this->cancellation = $product->cancellation;
            $this->duration = $product->duration;
            $this->difficulty = $product->difficulty;
            $this->pets_allowed = $product->pets_allowed;
            $this->accessibility = $product->accessibility;
            $this->reception_staff = $product->reception_staff ?: [];
            // Step 5
            $this->destination_id = $product->destination_id;
            $this->meeting_point = $product->meeting_point;
            // Step 6
            $this->keywords = $product->keywords ?: [];
            // Step 7
            $this->incl_services = [];
            foreach ($this->product->included_services as $item) {
                $this->incl_services[$item->item] = [
                    'type' => $item->type,
                    'item' => $item->item,
                    'restrictions' => $item->restrictions,
                    'languages' => $item->languages,
                    'price' => $item->price,
                    'price_per' => $item->price_per,
                ];
            }
            // Step 8
            foreach ($this->product->extra_services as $item) {
                $this->extr_services[$item->item] = [
                    'type' => $item->type,
                    'item' => $item->item,
                    'restrictions' => $item->restrictions,
                    'languages' => $item->languages,
                    'price' => $item->price,
                    'price_per' => $item->price_per,
                ];
            }
            // Step 9
            $this->not_suitable = $product->not_suitable ?: [];
            $this->not_allowed = $product->not_allowed ?: [];
            $this->mandatory_items = $product->mandatory_items ?: [];
            $this->preliminary_informations = $product->preliminary_informations;
            foreach ($this->product->faqs as $item) {
                $this->faqs[$item->id] = [
                    'title' => $item->title,
                    'content' => $item->content,
                ];
            }
            $this->contact = $product->contact;
            // Step 10
            $this->images = $product->images;
            // Step 11
            $this->booking_type = $product->booking_type;
            // Step 12
            $this->payment_type = $product->payment_type;
        } else {
            $this->product = new Product();
        }
    }

    public function updateIncludedService($type, $item)
    {
        if (array_key_exists($item, $this->incl_services)) {
            unset($this->incl_services[$item]);
        } else {
            $this->incl_services[$item] = [
                'type' => $type,
                'item' => $item,
                'restrictions' => [],
                'languages' => [],
                'price' => null,
                'price_per' => null,
            ];
        }
    }

    public function updateExtraService($type, $item)
    {
        if (array_key_exists($item, $this->extr_services)) {
            unset($this->extr_services[$item]);
            $this->product->extra_services()->where('type', $type)->where('item', $item)->delete();
        } else {
            $this->extr_services[$item] = [
                'type' => $type,
                'item' => $item,
                'restrictions' => [],
                'languages' => [],
                'price' => null,
                'price_per' => 'person',
            ];
        }
    }

    public function submit()
    {
        $step = $this->product->temporary_step ?? $this->product->current_step;
        match ($step) {
            7 => call_user_func(function () {
                foreach ($this->incl_services as $incl_service) {
                    $this->product->included_services()->updateOrCreate([
                        'type' => $incl_service['type'],
                        'item' => $incl_service['item'],
                    ], $incl_service);
                }
            }),
            8 => call_user_func(function () {
                $this->validation(8);
                foreach ($this->extr_services as $extr_service) {
                    $this->product->extra_services()->updateOrCreate([
                        'type' => $extr_service['type'],
                        'item' => $extr_service['item'],
                    ], $extr_service);
                }
            }),
            9 => call_user_func(function () {
                $this->validation(9);
                $this->product->faqs()->delete();
                foreach ($this->faqs as $faq) {
                    $this->product->faqs()->create([
                        'title' => $faq['title'],
                        'content' => $faq['content'],
                    ]);
                }
            }),
            10 => call_user_func(function () {
                $this->validation(10);
                if (count($this->uploaded_images)) {
                    foreach ($this->uploaded_images as $image) {
                        $path = Storage::disk('public')->put('products/'.$this->product->id.'/images', new File($image['path']));
                        $this->product->images()->create([
                            'path' => $path,
                        ]);
                    }
                }
                $this->uploaded_images = [];
            }),
            13 => call_user_func(function () {
                if (! $this->product->temporary_step) {
                    $this->product->update([
                        'status' => 'published',
                    ]);
                }
            }),
            default => call_user_func(function () {
                $validated = $this->validation($this->product->temporary_step ?? $this->product->current_step);
                $this->product->update($validated);
            })
        };
    }

    protected function validation($step)
    {
        return match ($step) {
            1 => $this->validate([
                'category_id' => ['required'],
            ]),
            2 => $this->validate([
                'typology_id' => ['required'],
            ]),
            3 => $this->validate([
                'name' => ['required'],
            ]),
            4 => $this->validate([
                'description' => ['required'],
                'cancellation' => ['required'],
                'duration' => ['required'],
                'difficulty' => ['required'],
                'pets_allowed' => ['required'],
                'accessibility' => ['required'],
                'reception_staff' => ['required'],
            ]),
            5 => $this->validate([
                'destination_id' => ['required'],
                'meeting_point' => ['nullable'],
                'meeting_point_coords' => ['nullable'],
            ]),
            6 => $this->validate([
                'keywords' => ['sometimes'],
            ]),
            7 => $this->validate([
                'incl_services' => ['sometimes'],
            ]),
            8 => $this->validate([
                'extr_services' => ['sometimes'],
                'extr_services.*.price' => ['required'],
            ]),
            9 => $this->validate([
                'not_suitable' => ['sometimes'],
                'not_allowed' => ['sometimes'],
                'mandatory_items' => ['sometimes'],
                'preliminary_informations' => ['sometimes'],
                'contact' => ['sometimes'],
            ]),
            10 => $this->validate([
                'uploaded_images' => 'min:'. 4 - $this->product->images->count(),
            ], [
                'uploaded_images.min' => __('Devi inserire almeno 4 foto.'),
            ]),
            11 => $this->validate([
                'booking_type' => ['required'],
            ]),
            12 => $this->validate([
                'payment_type' => ['required'],
            ])
        };
    }

    public function addFaq()
    {
        $this->faqs[] = [
            'title' => '',
            'content' => '',
        ];
    }

    public function removeFaq($index)
    {
        unset($this->faqs[$index]);
        $this->faqs = array_values($this->faqs);
    }
}
