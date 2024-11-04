<?php

namespace App\Mail;

use App\Models\AvailabilityDate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotFoundOrders extends Mailable
{
    use Queueable, SerializesModels;

    public AvailabilityDate $availability_date;

    public $users;

    /**
     * Create a new message instance.
     */
    public function __construct(AvailabilityDate $availability_date, $users)
    {
        $this->availability_date = $availability_date;
        $this->users = $users;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Not Found Orders',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.not-found-orders',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
