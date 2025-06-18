<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password TaniXpres',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Email.reset',
            with: [
                'url' => $this->url
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
