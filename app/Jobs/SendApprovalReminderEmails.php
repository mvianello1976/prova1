<?php

namespace App\Jobs;

use App\Mail\ApprovalReminder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApprovalReminderEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders = Order::where('status', 'to_approve')->get();

        foreach ($orders as $order) {
            $data = $order->data;
            $bookingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking']['date'] . ' ' . $data['booking']['time']);

            // Calcolo della differenza in ore tra la data di prenotazione e il momento attuale
            $hoursDifference = Carbon::now()->diffInHours($bookingDateTime, false);

            // Verifica se l'ordine inizia tra meno di 12 ore dal momento attuale
            if ($hoursDifference <= 12 && $hoursDifference > 0) {
                Mail::to($order->partner->email)->send(new ApprovalReminder($order));
            }
        }
    }
}
