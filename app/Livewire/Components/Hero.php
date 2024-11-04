<?php

namespace App\Livewire\Components;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\Destination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Hero extends Component
{
    public $destinations = [];

    public $selectedDestination = null;

    public $date = null;

    public function mount()
    {
        $this->date = session()->get('date');
        $this->destinations = Destination::all()->map(function ($item, $k) {
            return [
                'id' => $item->id,
                'value' => $item->name,
            ];
        });
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
//            ->having('distance', '<', 2) // 2km radius
            ->orderBy('distance')
            ->first();

        $this->setDestination($destination->id);
    }

    public function setDestination($id)
    {
        $destination = Destination::find($id);

        $this->selectedDestination = [
            'id' => $destination->id,
            'value' => $destination->name,
            'slug' => $destination->slug,
        ];
    }

    public function search()
    {
        return redirect()->route('guest.search', [
            'destination' => $this->selectedDestination['slug'],
            'category' => null,
            'product' => null,
            'participants' => null,
            'date' => rescue(fn () => Carbon::createFromFormat('d/m/Y', $this->date)->format('Y/m/d'), $this->date),
        ]);
    }

    public function render()
    {
        return view('livewire.components.hero');
    }
}
