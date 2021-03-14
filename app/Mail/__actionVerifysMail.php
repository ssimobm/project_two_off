<?php

namespace App\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use VerifiesEmails;
use App;
use DB;
use Carbon\Carbon;
use App\User;
use App\PasswordReset;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Password;
use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;




use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;







class ___actionVerifysMail extends Mailable
{
    use Queueable, SerializesModels;
    use SendsPasswordResetEmails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct()
         {



         }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

//     {  $User = User::where('email', 'simo2019pro@gmail.com')->firstOrFail();
//   //     dd(app('auth.password.broker')->createToken($User));
//   $reset = PasswordReset::where('email', $User->email)->firstOrFail();
//
//   //$reset = DB::table("password_resets")->where('email', $User->email)->first();
//
//
//
// if (Hash::check('7be167459327376dc7222209877c5f860d6001b391446948473e3092839b8792', $reset->token)) {
//
//   dd($reset->delete());
// }
//
//
//
//
//
//
//
//
//
// dd(Hash::check('7be167459327376dc7222209877c5f860d6001b391446948473e3092839b8792', $reset->token));
//
// //  if(!Hash::check('06e37d674fb897fa1bfff1411ea01dd5b21059a2d1c3b79b513dbf61b3261f48', $reset->token)) //throw error, token invalid
// //
// //  $user = User::where('email', '=', $request->email)->first();
// // }
// // dd(Hash::make('06e37d674fb897fa1bfff1411ea01dd5b21059a2d1c3b79b513dbf61b3261f48'));
//     //  dd(app('auth.password.broker')->createToken($User));
//       dd(new ResetPasswordNotification('b51cc71dc496f63f0a88b974c946cd76b66400538fcc9f86ac120858edccc873'));
//       dd(Password::broker('username'));
// dd(Hash::make('$2y$10$ytz1Wgf3R9TKn9SV4NxNBO4rXPik6RExOQ2541/GITIfiX1eeuAhW'));
//
//
//     //  dd(app('auth.password.broker')->createToken($User));
//     //  dd($User->createNewToken());
//       $response = $this->broker()->sendResetLink(['email' => $User->email]);
//
//
//               dd($response);
//
//       $token = 'sdsdsdsdsdsdsdsd';
//
//       DB::table('password_resets')->insert([
//           'email'      => $User->email,
//           'token'      => $token,
//           'created_at' => Carbon::now()
//       ]);
//
//     dd($token);
// dd(url(config('app.url').route('password.reset', (new ResetPassword)->token, false)));
//
// dd($url);
//       $link = URL::temporarySignedRoute(
//           'verification.verify',
//           Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
//           [
//               'id' => auth()->user()->getKey(),
//               'hash' => sha1(auth()->user()->getEmailForVerification()),
//           ]
//       );

      return $this//->from(env('MAIL_USERNAME'), 'Mailtrap-verify')
                  ->subject('Mailtrap Confirmation')
                  ->markdown('emails.verifys')
                  ->with([
                      'name' => config('app.name'),
                      'link' => $link
                    ]);



    //    return $this->markdown('emails.verifys',["link"=>$link]);
    }
}
