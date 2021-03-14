<?php
namespace App\Http\Controllers\AdminCp\Admin\Data;
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

class ApiAllControl extends Controller
{


  public function __construct(User $user)
  {
    $this->middleware('admin');
    $this->middleware('siteonline');
    $this->middleware('views')->only('index') ;
    $this->middleware('create')->only('create','store') ;
    $this->middleware('edit')->only('edit','update') ;
    $this->middleware('delete')->only('delete') ;
    //$this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');

  }

  public function movies(Request $request)
  {
    MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

   $DbMovies= new New_Movies ;
   $apidata = new SimoPhp ;

   $chek= $DbMovies->where('tmdb_id', $request->id_data??$request->ids)->first() ;
     if ($chek) {
     $DbMovies = $chek ;
     }
   $movie = $apidata->ApiOneAuto($request->id_data??$request->ids,"movie",$chek) ;
     if (!$chek or $chek) {
     $DbMovies->title = $movie['title'] ;
     $DbMovies->title_org = $movie['title_org'] ;
     $DbMovies->type = "movies" ;
     $DbMovies->content = $movie['overview'] ;
     if (!$chek) {
       $DbMovies->slug  = Str::slug($movie['title'], '-');
       $DbMovies->folder_date  = $movie['Date_folder'] ;
       $DbMovies->timestamps ;
     }
     $DbMovies->tmdb_id  = $movie['tmdb_id'] ;
     $DbMovies->imdb_id  = $movie['imdb_id'] ;

   if (!$chek)  {
     Auth::user()->UserTvshows()->save($DbMovies);
   }else {
     Auth::user()->UserTvshows()->save($chek);
   }

// start save info movies meta
foreach ($movie["info"] as $key => $value) {
  $info_movie = new New_Movies_Meta ;
  $check = $info_movie->where("tv_id", $chek->id??$DbMovies->id)
                      ->where('type', 'movies')
                      ->where('simokey', $key)
                      ->first();

  if (!$check) {
    $info_movie->type = "movies" ;
    $info_movie->simokey = $key ;
    $info_movie->user_id =  $chek->user_id??$DbMovies->user_id ;
    $info_movie->simovalue =  $value ;
  }else {
  $check->simovalue =  $value ;
  $check->save();
  }
  if (!$chek) {
  $DbMovies->tvdata()->save($info_movie);
}else {
  $info_movie->simokey = $key ;
  $info_movie->type = "movies" ;
  $info_movie->user_id =  $chek->user_id ;
  $info_movie->tv_id = $chek->id ;
  $chek->tvdata()->save($info_movie);
}


}
   // foreach ($movie["info"] as $key => $value) {
   //   $info_movie = new New_Movies_Meta ;
   //   $info_movie->type = "movies" ;
   //   $info_movie->simokey = $key ;
   //   $info_movie->simovalue =  $value ;
   //   $info_movie->user_id =  $DbMovies->user_id ;
   //   $DbMovies->tvdata()->save($info_movie);
   // }
// end save info movies meta
    //dd($DbMovies);
    //$apidata->Categorys($request->category, 'movies', $DbMovies->id);
    $apidata->Tags($movie["genres"], 'movies', $DbMovies);
   }
  // end check
  if (isset($request->ids) && $DbMovies->tmdb_id??$chek->tmdb_id) {
    $tmdb_id = $DbMovies->tmdb_id??$chek->tmdb_id ;
    return $tmdb_id ;
  }
  if (isset($request->id_data) && $DbMovies->tmdb_id??$chek->tmdb_id) {
    $id = $DbMovies->id??$chek->id ;
    return redirect('movies/edit/'.$id)->with('status', 'Profile updated!');
  }



  }
  public function tvshows(Request $request)
  {
    MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

    $DbMovies= new New_Tvshows ;
    $apidata = new SimoPhp;
    $chek= $DbMovies->where('tmdb_id', $request->id_data??$request->ids)->first() ;
    if ($chek) {
    $DbMovies = $chek ;
    }
    $movie = $apidata->ApiOneAuto($request->id_data??$request->ids,"tvshow",$chek) ;
    if (!$chek or $chek) {
    $DbMovies->title = $movie['title'] ;
    $DbMovies->title_org = $movie['title_org'] ;
    $DbMovies->type = "tvshows" ;
    $DbMovies->content = $movie['overview'] ;
    if (!$chek) {
      $DbMovies->slug  = Str::slug($movie['title'], '-');
      $DbMovies->folder_date  = $movie['Date_folder'] ;
      $DbMovies->timestamps ;
    }
    $DbMovies->tmdb_id  = $movie['tmdb_id'] ;
    $DbMovies->imdb_id  = $movie['imdb_id'] ;

  if (!$chek)  {
    Auth::user()->UserTvshows()->save($DbMovies);
  }else {
    Auth::user()->UserTvshows()->save($chek);
  }


 // start save info movies meta
    foreach ($movie["info"] as $key => $value) {
      $info_movie = new New_Tvshows_Meta ;
      $check = $info_movie->where("tv_id", $chek->id??$DbMovies->id)
                          ->where('type', 'tvshows')
                          ->where('simokey', $key)
                          ->first();

      if (!$check) {
        $info_movie->type = "tvshows" ;
        $info_movie->simokey = $key ;
        $info_movie->user_id =  $chek->user_id??$DbMovies->user_id ;
        $info_movie->simovalue =  $value ;
      }else {
      $check->simovalue =  $value ;
      $check->save();
      }
      if (!$chek) {
      $DbMovies->tvdata()->save($info_movie);
    }else {
      $info_movie->simokey = $key ;
      $info_movie->type = "tvshows" ;
      $info_movie->user_id =  $chek->user_id ;
      $info_movie->tv_id = $chek->id ;
      $chek->tvdata()->save($info_movie);
    }


    }
 // end save info movies meta
     //dd($DbMovies);
     //$apidata->Categorys($request->category, 'movies', $DbMovies->id);
     $apidata->Tags($movie["genres"], 'tvshows', $check??$DbMovies);
    }
   // end check
   if (isset($request->ids) && $DbMovies->tmdb_id??$chek->tmdb_id) {
     $tmdb_id = $DbMovies->tmdb_id??$chek->tmdb_id ;
     return $tmdb_id ;
   }
   if (isset($request->id_data) && $DbMovies->tmdb_id??$chek->tmdb_id) {
     $id = $DbMovies->id??$chek->id ;
     return redirect('tvshows/edit/'.$id)->with('status', 'Profile updated!');
   }
  }

  public function seasons(Request $request,$tv)
  {
    MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
$DbMovies= New_Tvshows::find($tv) ;

  $apidata = new SimoPhp;


  $Seasons = new Seasons;

if (isset($request->tmdb_id)) {
  $chek= $Seasons
         ->where('id', $tv)
         ->first() ;
}else {
  $chek= $Seasons
         ->where('tv_id', $DbMovies->id)
         ->where('season_nm', $request->sea_id??$request->ids)
         ->where('tmdb_id', $DbMovies->tmdb_id)
         ->first() ;
}

$movie = $apidata->ApiOneAuto($request->tmdb_id??$DbMovies->tmdb_id,"season",$chek,$request->sea_id??$request->ids) ;


         if (isset($chek)) {
          $Seasons = $chek ;
         }

        if (!isset($chek)) {
          $Seasons->tv_id = $DbMovies->id;
          $Seasons->tmdb_id = $DbMovies->tmdb_id;
          $Seasons->slug = Str::slug($Seasons->name , "-");
          $Seasons->folder_date  = $movie['Date_folder'] ;
          $Seasons->tvshow_slug = $DbMovies->slug ;
          $Seasons->tvshow_img = $DbMovies->tvdata->where('simokey', 'postimg')->first()->simovalue;
          $Seasons->name = ($chek->title_org??$DbMovies->title_org).' '.$movie['title'];
          $Seasons->name_tvshow = ($chek->title_org??$DbMovies->title_org);
     // end save info movies meta
        }

        if (!isset($chek->post_img)) {
          $Seasons->post_img = $movie["postimg"] ;
        }
        $Seasons->overview = $movie['overview'];
        $Seasons->name_season = $movie['title'];
        $Seasons->season_nm = $movie["season_nm"] ;
        $Seasons->episode_nm = $movie["episode_nm"] ;
        $Seasons->first_date = $movie["first_date"];
        Auth()->user()->UserSeasons()->save($Seasons);
       // end check

     if (isset($request->ids) && $Seasons->tmdb_id??$chek->tmdb_id) {
       $season_nm = $Seasons->season_nm??$chek->season_nm ;
       return $season_nm ;
     }
     if (isset($request->sea_id) && $Seasons->tmdb_id??$chek->tmdb_id) {
        $id = $Seasons->id??$chek->id ;
       return redirect('admincp/seasons/edit/'.$id)->with('status', 'Profile updated!');
     }
  }
  public function episodes(Request $request,$tv,$season)
  {
    MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

    $seasons= Seasons::find($request->seasonid??$season) ;
    $apidata = new SimoPhp;

    $DbTVshows = new Episodes;
    $chek= $DbTVshows
           ->where('sea_id', $seasons->id)
           //->where('season_nm', $seasons->season_nm)
           ->where('episode_nm', $request->ep_data??$request->ids)
           ->first() ;
    $movie = $apidata->ApiOneAuto($seasons->tmdb_id,"episode",$chek,$seasons->season_nm,$request->ep_data??$request->ids) ;

           if (isset($chek->id)) {
            $DbTVshows = $chek ;
           }
           $DbTVshows->name = $seasons->name_tvshow.' '.$seasons->name_season.' الحلقة '.$movie['episode_nm'];
           $DbTVshows->slug = Str::slug($DbTVshows->name , "-");
           $DbTVshows->overview = $movie['overview'];
           $DbTVshows->name_season = $seasons->name_season;
           $DbTVshows->name_episode = $movie['title'];
           $DbTVshows->name_tvshow = $seasons->name_tvshow ;
           $DbTVshows->first_date = $movie['first_date'];
           $DbTVshows->season_nm = $seasons->season_nm ;
           $DbTVshows->episode_nm = $movie['episode_nm'] ;
           $DbTVshows->rating = $movie['rating'] ;
           $DbTVshows->vote_count = $movie['vote_count'] ;
           if (strlen($DbTVshows->post_img) == 0) {
            $DbTVshows->post_img = $movie['postimg'];
           }

           if (!isset($chek->id)) {

             $DbTVshows->tv_id = $seasons->tv_id;
             $DbTVshows->sea_id = $seasons->id;
             $DbTVshows->folder_date = $movie['Date_folder'];
             $DbTVshows->tmdb_id = $seasons->tmdb_id;

           }
           Auth()->user()->UserEpisodes()->save($DbTVshows);




           if (isset($request->ids) && $DbTVshows->tmdb_id??$chek->tmdb_id) {
             $episode_nm = $DbTVshows->episode_nm??$chek->episode_nm ;
             return $episode_nm ;
           }
           if (isset($request->ep_data) && $DbTVshows->tmdb_id??$chek->tmdb_id) {
             $id = $DbTVshows->id??$chek->id ;
             return redirect('episodes/edit/'.$id)->with('status', 'Profile updated!');
           }
  }
}
