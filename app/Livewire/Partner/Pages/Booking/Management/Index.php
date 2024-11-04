<?php

namespace App\Livewire\Partner\Pages\Booking\Management;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search = null;

    public $payment_status = null;

    public $date = null;

    //    public $tabs = [
    //        'approved' => 'Approvate',
    //        'to_approve' => 'Da approvare',
    //        'canceled' => 'Annullate',
    //    ];

    #[Url]
    public $currentTab = 'approved';

    public function render()
    {
        $orders = auth()->user()->orders();
        
        $orders = $orders->where('status', $this->currentTab)
            ->where(function ($query) {
                $query->where('is_gift', false)
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('is_gift', true)
                            ->whereColumn('gift_from', '!=', 'user_id');
                    });
            });

        if ($this->search) {
            $orders = $orders->search($this->search, [
                'uuid',
                'user.first_name',
                'user.last_name',
                'user.email',
            ]);
            $orders = $orders->orWhere(DB::raw("LOWER(data->'$.product.name')"), 'LIKE', '%'.strtolower($this->search).'%');
        }

        if ($this->payment_status) {
            $orders = $orders->where('payment_status', $this->payment_status);
        }

        if ($this->date) {
            $d = Carbon::createFromFormat('d/m/Y', $this->date)->format('Y-m-d');
            $orders = $orders->where(DB::raw("DATE_FORMAT(data->'$.booking.date', '%Y-%m-%d')"), '=', $d);
        }

        $to_approve = auth()->user()->orders()
            ->where('status', 'to_approve')
            ->where(function ($query) {
                $query->where('is_gift', false)
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('is_gift', true)
                            ->whereColumn('gift_from', '!=', 'user_id');
                    });
            })
            ->count();

        return view('livewire.partner.pages.booking.management.index', [
            'orders' => $orders->paginate(25),
            //            'approved' => auth()->user()->orders()->where('status', 'approved')->count(),
            'to_approve' => $to_approve
        ]);
    }
}
