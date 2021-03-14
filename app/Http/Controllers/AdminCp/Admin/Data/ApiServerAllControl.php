<?php


// .navbar-custom .app-search {
//     height: 50px;
//     position: absolute;
//     width: 50%;
//     margin: auto;
//     left: 0;
//     right: 0;
// }





namespace App\Http\Controllers\AdminCp\Admin\Data;
use App\Http\Controllers\Controller;

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
use App\Models\MyClass\MyClass2;
use Illuminate\Support\Str;
//use App\Models\MyClass\MyFunction;
use App\MyClass\SimoPhp;

class ApiServerAllControl extends Controller
{


  public function __construct(User $user)
  {
    $this->middleware('siteonline');
    $this->middleware('views')->only('index') ;
    $this->middleware('create')->only('create','store') ;
    $this->middleware('edit')->only('edit','update') ;
    $this->middleware('delete')->only('delete') ;
    $this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');
  }

  public function tvshows(Request $request)
  {

    $DbMovies= new New_Tvshows ;
    $apidata = new SimoPhp;
    $Episodes = new Episodes;
    $Episode = $Episodes->where('name_tvshow', "like" ,'%'."Bleach".'%')->get()->all();
    foreach ($Episode as $key => $value) {
      $url = "http://filmoq.md/simo/100645/".$value->season_nm."/".$value->episode_nm;
      $url = json_decode(file_get_contents($url));

      if ($url) {
        $Ep = json_decode($url->data)->players;

        foreach ($Ep as $k => $v) {
           $apidata = new SimoPhp;
           $epp[$k] = (array)$v ;
        }

         $apidata->serversdb($epp,$value,'episode','player');
      }

       //$apidata->serversdb($request->download,$DbTVshows,'episode','download');

    }
//    $movie = $apidata->ApiOneAuto($request->id_data??$request->ids,"tvshow") ;
//    $chek= $DbMovies->where('tmdb_id', $request->id_data??$request->ids)->first() ;




  }

  public function seasons(Request $request,$tv)
  {
  $DbMovies= New_Tvshows::find($tv) ;
  $apidata = new SimoPhp;
  $Seasons = new Seasons;

  $chek= $Seasons
         ->where('tv_id', $DbMovies->id)
         ->where('season_nm', $request->sea_id??$request->ids)
         ->where('tmdb_id', $DbMovies->tmdb_id)
         ->first() ;
  $movie = $apidata->ApiOneAuto($DbMovies->tmdb_id,"season",$chek,$request->sea_id??$request->ids) ;




        if (!$chek) {
          $Seasons->tv_id = $DbMovies->id;
          $Seasons->name = $DbMovies->title_org.' '.$movie['title'];
          $Seasons->slug = Str::slug($Seasons->name , "-");
          $Seasons->overview = $movie['overview'];
          $Seasons->name_season = $movie['title'];
          $Seasons->name_tvshow = $DbMovies->title_org;
          $Seasons->season_nm = $movie["season_nm"] ;
          $Seasons->episode_nm = $movie["episode_nm"] ;
          $Seasons->tmdb_id = $DbMovies->tmdb_id;
          $Seasons->post_img = $movie["postimg"] ;
          $Seasons->first_date = $movie["first_date"];
          $Seasons->folder_date  = $movie['Date_folder'] ;
          Auth()->user()->UserSeasons()->save($Seasons);
     // end save info movies meta
         //dd($DbMovies);
        }
       // end check

     if (isset($request->ids) && $Seasons->tmdb_id??$chek->tmdb_id) {
       $season_nm = $Seasons->season_nm??$chek->season_nm ;
       return $season_nm ;
     }
     if (isset($request->sea_id) && $Seasons->tmdb_id??$chek->tmdb_id) {
        $id = $Seasons->id??$chek->id ;
       return redirect('seasons/edit/'.$id)->with('status', 'Profile updated!');
     }
  }
  public function episodes(Request $request,$tv,$season)
  {
    $seasons= Seasons::find($request->seasonid??$season) ;
    $apidata = new SimoPhp;

    $DbTVshows = new Episodes;
    $chek= $DbTVshows
           ->where('sea_id', $seasons->id)
           ->where('season_nm', $seasons->season_nm)
           ->where('episode_nm', $request->ep_data??$request->ids)
           ->where('tmdb_id', $seasons->tmdb_id)
           ->first() ;
    $movie = $apidata->ApiOneAuto($seasons->tmdb_id,"episode",$chek,$seasons->season_nm,$request->ep_data??$request->ids) ;

           if (!isset($chek->id) or isset($chek->id)) {
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
           if (!isset($DbTVshows->post_img)) {
            $DbTVshows->post_img = $movie['postimg'];
           }

           if (!isset($chek->id)) {

             $DbTVshows->tv_id = $seasons->tv_id;
             $DbTVshows->sea_id = $seasons->id;
             $DbTVshows->folder_date = $movie['Date_folder'];
             $DbTVshows->tmdb_id = $seasons->tmdb_id;

           }

           Auth()->user()->UserEpisodes()->save($DbTVshows);
           }


           if (isset($request->ids) && $DbTVshows->tmdb_id??$chek->tmdb_id) {
             $episode_nm = $DbTVshows->episode_nm??$chek->episode_nm ;
             return $episode_nm ;
           }
           if (isset($request->ep_data) && $DbTVshows->tmdb_id??$chek->tmdb_id) {
             $id = $DbTVshows->id??$chek->id ;
             return redirect('admincp/episodes/edit/'.$id)->with('status', 'Profile updated!');
           }
  }
}
