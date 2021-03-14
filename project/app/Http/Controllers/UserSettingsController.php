<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class UserSettingsController extends Controller
{

    public function index()
    {

        return view('sites.users.Auth.UserSettings',["user"=> auth()->user()]);
    }
    public function update(Request $request)
    {


    // $validator =  request()->validate([
    //   'email' => 'required|email|unique:users,email',
    //   'user' => 'required|min:4|max:10|unique:users,username',
    //   'namefirst' => 'required|min:4|max:10',
    //       ],[
    //           'namefirst.required' => 'Namm is required',
    //           'namefirst.min' => 'Namm must be max 255 length',
    //           'namefirst.max' => 'Namm must be max 10'
    //       ]);


    $input = $request->all();
     $rules = [

       'email' => 'required|email|confirmed|max:255|unique:users,email,'.auth()->user()->id.',id',
              // 'user' => 'required|min:4|max:14|unique:users,username,'.auth()->user()->id.',id',
               'namefirst' => 'required|min:4|max:15',
           ];
     $messages = [
       //  'namefirst.required' => 'simoo is required',
         //'namefirst.min' => 'simoo must be max 255 length',
       //  'namefirst.max' => 'simoo must be max 10',
         // 'email.required' => 'email is required',
         // 'email.min' => 'email must be max 255 length',
         // 'email.max' => 'email must be max 10'
     ];
     $validator = Validator::make($input, $rules, $messages);

$user = auth()->user() ;


$user->email = $request->email;
//$user->username = $request->user;
$user->name = $request->namefirst;
$user->save() ;

return redirect()->back()->withErrors($validator)->withInput()->with('success', 'Saved Data has been successfully!');

 }


   public function error(Request $request)
    {
 $input = $request->all();
  $rules = [

    'email' => 'required|email|confirmed|max:255|unique:users,email,'.auth()->user()->id.',id',
   'email_confirmation' => 'required|email|max:255|',


  //  'user' => 'required|min:4|max:14|unique:users,username,'.auth()->user()->id.',id',
    'namefirst' => 'required|min:4|max:15',
        ];
  $messages = [
    //  'namefirst.required' => 'simoo is required',
      //'namefirst.min' => 'simoo must be max 255 length',
    //  'namefirst.max' => 'simoo must be max 10',
      // 'email.required' => 'email is required',
      // 'email.min' => 'email must be max 255 length',
      // 'email.max' => 'email must be max 10'
  ];

  $validator = Validator::make($input, $rules, $messages);
  $errors = $validator->errors();
  $arrayName = array('email_confirmation' => $errors->first('email_confirmation'), 'email' => $errors->first('email'), 'namefirst' => $errors->first('namefirst'),'user' => $errors->first('user'),);


if (count($errors) > 0) {
  return ["errors" => $arrayName , "very" => true];
}

  return ["errors" => $arrayName , "very" => false];


    }
}
