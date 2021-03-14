<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seasons;
use Gate;
//use Auth;
use App\Models\User;
class HomeController extends Controller
{

  public function __construct()
  {
    //  $this->middleware('admin');
        $this->middleware(['verified']);

  }
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
    //  $this->authorize('guest', $user);
  //   $this->authorize("update", $user);
//{"create":"yes","edit":"no","delete":"yes","view":"yes","admin":"yes","update":"yes","editor_tv":"yes","editor_movies":"yes","editor_ep":"yes","editor":"yes","comment":"yes","likes":"yes","favoris":"yes","watch_later":"yes","watch_now":"yes","api":"yes"}
// $simo = array('create' => 'yes', 'delete' => 'yes', 'view' => 'yes', 'admin' => 'no' , 'update' =>'no', );
// $simo = json_encode($simo) ;
// dd($simo);
//dd(auth()->user()->AdminUser());

//$json = json_decode(auth()->user()->UserMeta->UserRole->type_value) ;

//$this->authorize('create', $user);


// $json = json_decode(auth()->user()->UserMeta->UserRole->type_value) ;
// foreach ($json as $k => $v) {
//
//   if ($v == 'yes') {
//   echo "$k<br>";
// }else {
//   echo "no $k<br>";
// }
//
// }
// dd(auth()->user()->UserMeta->UserRole->type_value);
//dd(Auth()->user()->id);
        //        dd($Seasons->find(1));

        // $user = factory(User::class)->Create();
        //
        // dd(Auth()->login($user));
  //dd(Gate::check('create', App\Models\tv::class));
$Seasons = Seasons::find("1");

//Gate::check('create', App\Models\User::class);
//Gate::allows('user.create', 'RolesPolicy@create');
//$this->authorize('create', $user);
// if ($user->can('create', User::class)) {
//echo "<h1>Simo</h1>";
//}

        return view('sites.home');
    }
}
