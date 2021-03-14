<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\actionVerifysMail;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AllMailcontroller extends Controller
{
  
    public function VerifyAccount(Request $request)
    {

    //  Mail::to(auth()->user()->email)->send(new actionVerifysMail());

    Mail::to($request->user())->send(new actionVerifysMail());

      return 'A message has been sent to Mailtrap!';


    }
}
