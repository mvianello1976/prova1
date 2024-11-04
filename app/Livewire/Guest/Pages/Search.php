<?php

namespace App\Livewire\Guest\Pages;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Search extends Component
{
    public $destinations = [];

    public $categories = [];

    public $participants = [];

    public $products = [];

    public $selectedDestination;

    public $destinationValue = null;

    public $selectedCategory;

    public $date = null;

    public $participant = null;

    public function mount(Request $request)
    {
        session()->remove('destination_id');
        session()->put('date', Carbon::now()->format('Y/m/d'));
        session()->remove('adults');
        session()->remove('kids');
        session()->remove('children');

        if ($request->has('destination')) {
            $item = Destination::where('slug', $request->get('destination'))->first();
            $this->selectedDestination = [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug,
            ];
            $this->destinationValue = $item->name;
        }

        if ($request->has('category')) {
            $item = Category::where('slug', $request->get('category'))->first();
            $this->selectedCategory = [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug,
            ];
        }

        if ($request->has('date')) {
            $this->date = $request->get('date');
            session()->put('date', $this->date);
        }

        if ($request->has('participants')) {
            $this->participant = $request->get('participants');
            session()->put('adults', $this->participant);
        }

        $this->destinations = Destination::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug,
            ];
        });
        $this->categories = Category::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'value' => $item->name,
                'slug' => $item->slug,
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
            10,
        ];

        $this->products = Product::whereHas('availabilities')->where('status', 'published');
        if ($this->selectedDestination) {
            $this->products->where('destination_id', $this->selectedDestination['id']);
        }
        if ($this->selectedCategory) {
            $this->products->where('category_id', $this->selectedCategory['id']);
        }
        if ($this->date) {
            $date = $this->date;
            $this->products->whereHas('availabilities.dates', function ($q) use ($date) {
                $q->whereDate('date_start', '<=', $date);
                $q->whereDate('date_end', '>=', $date);
            });
        }
        $this->products = $this->products->get();
    }

    public function updatedDate()
    {
        $this->date = rescue(fn () => Carbon::createFromFormat('d/m/Y', $this->date)->format('Y/m/d'), $this->date);
    }

    public function setCategory($id)
    {
        $category = Category::find($id);

        $this->selectedCategory = [
            'id' => $category->id,
            'value' => $category->name,
            'slug' => $category->slug,
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
//            ->having('distance', '<', 2) // 2km radius
            ->orderBy('distance')
            ->first();

        $this->setDestination($destination->id);

        $this->search();
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
        session()->put('adults', $this->participant);
        session()->put('date', $this->date);

        return redirect()->route('guest.search', [
            'destination' => $this->selectedDestination['slug'] ?? null,
            'category' => $this->selectedCategory['slug'] ?? null,
            'participants' => $this->participant ?? null,
            'date' => $this->date,
        ]);
    }

    public function render()
    {
        return view('livewire.guest.pages.search');
    }
}
