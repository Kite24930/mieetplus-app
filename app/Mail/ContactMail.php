<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build() {
        return $this->to($this->data->email)
            ->subject('【就活サイト】お問い合わせありがとうございます')
            ->cc('info@mieet-plus.com')
            ->view('mails.contact')
            ->with([
                'data' => $this->data,
            ]);
    }
}
