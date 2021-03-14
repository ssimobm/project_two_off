<?php

namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;
use App\MyClass\MyFunction;
use App\Models\User ;

use App\Models\PasswordReset ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Password ;
use Validator;
use App\Mail\actionVerifysMail;
use Illuminate\Support\Facades\Mail;
class adminUserPassController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }

  public function error(Request $request)
   {
$input = $request->all();
$rules = ['password' => 'required|confirmed|same:password_confirmation|max:255|min:4',
'password_confirmation' => 'required|same:password|max:255|min:4'] ;

 $validator = Validator::make($input, $rules);
 $errors = $validator->errors();
 $arrayName = array('password' => $errors->first('password'),'password_confirmation' => $errors->first('password_confirmation'));

   return json_encode($arrayName);


   }

    public function index($id)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

    return view('admincp.Users.Users_pass' ,['id'=> user::find($id)->id]);
    }

    public function update(Request $request , $id)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

      $input = $request->all();
      $rules = ['password' => 'required|confirmed|same:password_confirmation|max:255|min:4',
      'password_confirmation' => 'required|same:password|max:255|min:4'] ;

       $validator = Validator::make($input, $rules);

  $user =  user::find($id) ;
  if ($request->password === $request->password_confirmation) {
    $user->password = Hash::make($request->password);
    $user->save();
  }
//Mail::to($request->user())->send(new actionVerifysMail());

    return redirect()->back()->withErrors($validator)->withInput()->with('success', 'Your change password has been sent successfully!');

    }
}
