<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Ini judul email yang bakal masuk ke inbox kamu
        return $this->subject('Pesan Baru dari Pelanggan Bar Bar!')
                    ->view('emails.contact');
    }
}