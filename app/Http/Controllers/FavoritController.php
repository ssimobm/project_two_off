<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New_Tvshows;
use App\Models\New_Movies;
use App\Models\Episodes;
use App\Models\Likes;
use Auth;
use App\MyClass\MyFunction;

class FavoritController extends Controller
{

  public function __construct()
  {
    $this->middleware('siteonline');
    //$this->middleware('views')->only('indexwatchContinue','indexWatchlater','index') ;
    $this->middleware('create')->only('create') ;
    $this->middleware('edit')->only('edit','update') ;
    $this->middleware('delete')->only('destroy') ;
  //  $this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');



  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function notification(\Auth $Auth)
     {

       $simo = $Auth::user()->UserFavorit()->get();

       MyFunction::authorizes(['AdmincpSuper','Admincp','Users']);

       return view('sites.Users.Users_postes',['simo'=> $simo]);

     }

public function indexwatchContinue()
{
  MyFunction::authorizes(['AdmincpSuper','Admincp','Watch_Now']);


$movies = Auth::user()->UserFavorit->where('liks_type', 'Watchlater_Ep') ;
// foreach ($movies as $k => $v) {
//   $link = $v->Episodes->first()->tv ;
//   dd($link);
// }

return view("Favorits.Watchlaterepisode",["movies" => $movies,]);
}
     public function indexWatchlater()
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp','Watch_later']);

    $movies = Auth::user()->UserFavorit->where('liks_type', 'Watchlater') ;

    return view("Favorits.WatchLater",["movies" => $movies,]);
     }

    public function index(Likes $likes)
    {

    MyFunction::authorizes(['AdmincpSuper','Admincp','Favorit']);

   $movies = Auth::user()->UserFavorit->where('liks_type', 'Favorit') ;

   return view("Favorits.movies",["movies" => $movies,]);
    }

    public function store(Request $request, $id , Likes $Likes )
    {
    //  MyFunction::permission(['create'], $Likes);

      if (isset(Auth::user()->id)) {
        if ($request->type == "movie") {
         $Movies= New_Movies::find($request->id) ;
        }
        if ($request->type == "tv") {
         $Movies= New_Tvshows::find($request->id) ;
        }
      if ($id == "watchcon") {
       $Movies= Episodes::find($request->id) ;
       $like = $Movies->Like->where('liks_type', 'Watchlater')->where('user_id', Auth::user()->id)->first();

      }
        if ($id == "Favorit") {
          $like = $Movies->Like->where('liks_type', 'Favorit')->where('user_id', Auth::user()->id)->first();
        }
        if ($id == "Notify") {
          $like = $Movies->Like->where('liks_type', 'Notify')->where('user_id', Auth::user()->id)->first();
        }
        if ($id == "Watchlater") {
          $like = $Movies->Like->where('liks_type', 'Watchlater')->where('user_id', Auth::user()->id)->first();
        }
        if ($id == "watchcon") {
          $like = $Movies->Like->where('liks_type', 'Watchlater_Ep')->where('user_id', Auth::user()->id)->first();
        }
        if (! isset($like)) {

          $Db = new Likes ;
          if ($id == "Favorit") {
          $Db->liks_type = 'Favorit' ;
          }
          if ($id == "Watchlater") {
          $Db->liks_type = 'Watchlater' ;
          }
          if ($id == "Notify") {
            $Db->liks_type = 'Notify' ;
          }

          if ($id == "watchcon") {
            $Db->liks_type = 'Watchlater_Ep' ;
            $Db->type = "episodes" ;
          }else {
          $Db->type = $Movies->type ;
          }


          $Db->parent_id = '0' ;
          $Db->user_id = Auth::user()->id ;
          $Db->liks = '1' ;
          $Db->timestamps ;
          $Movies->Like()->save($Db);
  return "success" ;
}else {
  return "exists" ;
}

      }
     // if (!isset(Auth::user()->id)) {
     //                return view('auth.ajaxlogin') ;
     //              }

return "login" ;
    }


    public function destroy(Request $request)
    {
      $type = null;
     if ($request->type == 'tv') {
      $type = "tvshows";
     }
     if ($request->type == 'movie') {
      $type = "movies";
     }
     if ($request->type == 'ep') {
      $type = "episodes";
     }
     if ($type) {
       $user1 = Auth::user()->UserFavorit->Where('type' ,$type)->Where('id' ,$request->id)->first();
   //    $this->authorize('deletes', $user1);
       $user1->forceDelete();
       return "success" ;
     }

    }



    public function DelletTypeAll(Request $request, \Auth $Auth, $id=null)
    {

      $active = false ;
      /// start code remove all Notification users
      if ($request->type === "notify") {
      $name = "Notify" ;
      }
      if ($request->type === "favorit") {
      $name = "Favorit" ;
      }
      if ($request->type === "watch_later") {
      $name = "Watchlater" ;
      }
      if ($request->type === "watch_episode") {
      $name = "Watchlater_Ep" ;
      }

      //end remove all
      if (isset($name)) {
        $data = $Auth::user()->UserFavorit()->where('liks_type', $name);
        if (isset($request->id)) {
          $data = $data->where('id', $request->id);
        }
        $data = $data->get();
        if (count($data) > 0) {
          foreach ($data as $key => $value) {
            $value->forceDelete();
          }
          $active = true ;
        }
      }
      return $active ;
    }

}
