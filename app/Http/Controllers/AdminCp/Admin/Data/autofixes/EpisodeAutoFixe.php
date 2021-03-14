<?php
namespace App\Http\Controllers\AdminCp\Admin\Data\autofixes;
use App\Http\Controllers\Controller;
use App\MyClass\MyFunction;
use Storage;
use Carbon\Carbon;
use App\Models\New_Movies;
use App\Models\New_Movies_Meta;
use App\Models\New_Tvshows;
use App\Models\New_Tvshows_Meta;
use App\Models\Season;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;
//use App\Models\MyClass\MyFunction;
use App\MyClass\SimoPhp;

class EpisodeAutoFixe extends Controller
{


  // public function __construct(User $user)
  // {
  //   $this->middleware('admin');
  //   $this->middleware('siteonline');
  //   $this->middleware('views')->only('index') ;
  //   $this->middleware('create')->only('create','store') ;
  //   $this->middleware('edit')->only('edit','update') ;
  //   $this->middleware('delete')->only('delete') ;
  //   //$this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');
  //
  // }
  public function index($id)
  {
    $link = Seasons::find($id);


    //$user = Seasons::paginate(24);
    $user = $link->episode;

    return view('admincp.fixbrowse.Seasons',['data' => $user]);
  }

  public function update(Request $request)
  {

    $arraySeason = explode(",", $request->array);
    $SeasonId = $arraySeason[0] ;
    $Season = Episodes::find($SeasonId);

    foreach ($arraySeason as $key => $value) {

         if ($request->SelectAll == "SelectAll") {
         $Seasons = Episodes::find($value);
         $arraySeason = explode(",", $request->array);
          foreach ($arraySeason as $k => $v) {
            if (isset($Seasons->id) && $k > 0 && $k != 0) {
              $episode = Episodes::find($v);
              if (isset($episode->id) && $episode->id != $Seasons->id && $episode->episode_nm == $Seasons->episode_nm && $episode->episode_nm != "0"  && $Seasons->episode_nm != "0") {
                foreach ($Seasons->server as $ser1 => $server1) {
                  $server1->type_id = $Seasons->id ;
                  $server1->save();
                }
              //  if (count($Seasons->server) == 0) {
                  $episode->delete();
                  $episode->forceDelete();

              //  }
              }
            }

          }

         }
         if ($request->SelectAll != "SelectAll") {
          if ($key > 0 && $key != 0) {
          // if ($key > 0 && $key != 0) {
          $Seasons = Episodes::find($value);
           if (isset($Season->id) && $Season->id !== $Seasons->id) {
             foreach ($Seasons->server as $ser => $server) {

               $server->type_id = $Season->id ;
               $server->save();
             }

           //  if (count($Seasons->server) == 0) {
               $Seasons->delete();
               $Seasons->forceDelete();

           //  }
           }
               }
         //}



       }




    }


return back();

  }

}
