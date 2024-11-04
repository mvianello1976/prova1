<?php

namespace App\Mail;

use App\Models\GiftCardUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendGiftCard extends Mailable
{
    use Queueable, SerializesModels;

    public $gift_card_user;

    /**
     * Create a new message instance.
     */
    public function __construct(GiftCardUser $gift_card_user)
    {
        $this->gift_card_user = $gift_card_user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Gift Card',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-gift-card',
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
