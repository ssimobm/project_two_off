<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use VerifiesEmails;
use App\User;
use App\PasswordReset;
class actionVerifysMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($user)
         {
   $this->user = $user ;

         }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this//->from(env('MAIL_USERNAME'), 'Mailtrap-verify')
                  ->subject('Filmoq Confirmation')
                  ->markdown('emails.verifys' , [ 'content' => $this->user,
                  'name' => config('app.name'),
                  'url' => url(route('password.reset', app('auth.password.broker')->createToken($this->user)).'?email='.$this->user->email),])
                  ;
    }
}
