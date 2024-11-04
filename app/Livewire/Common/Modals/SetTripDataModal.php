<?php

namespace App\Livewire\Common\Modals;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\Category;
use App\Models\Destination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class SetTripDataModal extends ModalComponent
{
    public $participant;

    public $destinations = [];
    public $categories = [];
    public $participants = [];
    public $selectedDestination = null;
    public $selectedCategory = null;
    public $date = null;

    public function mount($destination = null, $category = null, $participant = null, $date = null)
    {
        if ($destination) {
            $item = Destination::find($destination);
            $this->selectedDestination = [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug
            ];
        }
        if ($category) {
            $item = Category::find($category);
            $this->selectedCategory = [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug
            ];
        }
        if ($participant) {
            $this->participant = $participant;
        }
        if ($date) {
            $this->date = $date;
        }

        $this->destinations = Destination::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug
            ];
        });
        $this->categories = Category::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug
            ];
        });
        $this->participants = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10
        ];
    }

    public function setDestination($id)
    {
        $destination = Destination::find($id);

        $this->selectedDestination = [
            'id' => $destination->id,
            'value' => $destination->name,
            'slug' => $destination->slug
        ];
    }

    public function setCategory($id, $value)
    {
        $category = Category::find($id);

        $this->selectedCategory = [
            'id' => $category->id,
            'value' => $category->name,
            'slug' => $category->slug
        ];
    }

    public function geolocation()
    {
        // 101.56.208.248
        $ip = '101.56.208.248';
        $details = GeoLocation::lookup($ip);

        $latitude = $details->getLatitude();
        $longitude = $details->getLongitude();

        $destination = DB::table('destinations')
            ->select('id', 'name', 'latitude', 'longitude')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<', 2) // 2km radius
            ->orderBy('distance')
            ->first();

        $this->setDestination($destination->id, $destination->name);
    }

    public function search()
    {
        return redirect()->route('guest.search', [
            'destination' => $this->selectedDestination['slug'],
            'category' => $this->selectedCategory['slug'] ?? null,
            'participants' => $this->participant ?? null,
            'date' => rescue(fn() => Carbon::createFromFormat('d/m/Y', $this->date)->format('Y/m/d'), $this->date)
        ]);
    }

    public function render()
    {
        return view('livewire.common.modals.set-trip-data-modal');
    }
}
