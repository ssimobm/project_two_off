<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use VerifiesEmails;
class VerifysMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct()
         {
             $this->user = auth()->user();

         }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      dd(auth()->user()->sendEmailVerificationNotification());
        return $this->markdown('emails.verifys');
    }
}
