<?php
namespace App\Http\Controllers\Auth\custom;

use App\Http\Controllers\Controller;
use App\Models\User ;
use App\Models\PasswordReset ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Password ;
use Validator;
use Carbon\Carbon;


use App\Models\Mail\actionVerifysMail;
use Illuminate\Support\Facades\Mail;
class UserResetController extends Controller
{

  protected $maxAttempts = 3; // Default is 5
  protected $decayMinutes = 2; // Default is 1


  public function __construct()
  {

    //  $this->middleware('guest');
    //  $this->middleware('throttle:3,1');
  }



  public function error(Request $request)
   {
$input = $request->all();
$rules = ['email' => 'required|email|max:255|exists:users,email',] ;
//$rules = ['email' => 'required|email|max:255|unique:users,email,'.auth()->user()->UserMeta->UserRole->type.',email',

//'email' => 'required|email|confirmed|max:255|unique:users,email,'.auth()->user()->id.',id',
//] ;

 $validator = Validator::make($input, $rules);
 $errors = $validator->errors();
 $arrayName = array('email' => $errors->first('email'));

   return json_encode($arrayName);


   }

  public function index1()
  {
    return view('Users.Auth.reset1');

  }

  public function update1(Request $request , User $user)
  {
    $input = $request->all();
    $rules = ['email' => 'required|email|max:255|exists:users,email',] ;
    //$rules = ['email' => 'required|email|max:255|unique:users,email,'.auth()->user()->UserMeta->UserRole->type.',email',

    //'email' => 'required|email|confirmed|max:255|unique:users,email,'.auth()->user()->id.',id',
    //] ;

     $validator = Validator::make($input, $rules);
$User = $user->where('email', $request->email)->first() ;

if ($User) {

//Mail::to($User)->send(new actionVerifysMail($User));
  return redirect()->back()->withErrors($validator)->withInput()->with('success', 'Send Email has been successfully!');

}

return redirect()->back()->withErrors($validator)->withInput()->with('error', 'No Send Email');



  }



  public function index($token)
  {
    $User = User::where('email', 'simo2019pro@gmail.com')->firstOrFail();

  //  $token = app('auth.password.broker')->createToken($User);
dd($token);
  //  dd(app('auth.password.broker')->createToken($User));

    $reset = PasswordReset::where('email', $User->email)->firstOrFail();


  if (Hash::check($token, $reset->token)) {
   return view('Users.Auth.reset',['token' => $token]);
  //  dd($reset->delete());
  }

  }
}
