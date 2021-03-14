<?php

namespace App\Http\Controllers\Auth\custom;

use App\Http\Controllers\Controller;
use App\Models\User ;
use App\Models\PasswordReset ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Password ;
use Validator;
use App\Mail\actionVerifysMail;
use Illuminate\Support\Facades\Mail;
class UserChangePassController extends Controller
{

  public function error(Request $request)
   {
$input = $request->all();
$rules = ['password' => 'required|confirmed|same:password_confirmation|max:255|min:4',
'password_confirmation' => 'required|same:password|max:255|min:4'] ;

 $validator = Validator::make($input, $rules);
 $errors = $validator->errors();
 $arrayName = array('password' => $errors->first('password'),'password_confirmation' => $errors->first('password_confirmation'));


 if (count($errors) > 0) {
   return ["errors" => $arrayName , "very" => true];
 }

   return ["errors" => $arrayName , "very" => false];


   }

    public function index()
    {
    return view('sites.users.Auth.Pass');
    }

    public function update(Request $request)
    {

      $input = $request->all();
      $rules = ['password' => 'required|confirmed|same:password_confirmation|max:255|min:4',
      'password_confirmation' => 'required|same:password|max:255|min:4'] ;

       $validator = Validator::make($input, $rules);

  $user =  auth()->user() ;
  if ($request->password === $request->password_confirmation) {
    $user->password = Hash::make($request->password);
    $user->save();
  }
//Mail::to($request->user())->send(new actionVerifysMail());

    return redirect()->back()->withErrors($validator)->withInput()->with('success', 'Your change password has been sent successfully!');

    }
}
