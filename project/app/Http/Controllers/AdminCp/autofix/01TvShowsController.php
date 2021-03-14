<?php

namespace App\Http\Controllers\AdminCp\autofix;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyClass\SimoPhp;
use App\MyClass\MyFunction;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\New_Tvshows;

use App\Models\New_Movies_Meta;
use App\Models\New_Movies;
use App\Models\New_Tvshows_Meta;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\Categorys;
use App\Models\CategorysMeta;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\Options;
use App\Models\User;
use Auth ;
class 01TvShowsController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth');
  //     $this->middleware('auth');
  //     $this->middleware('admin');
  //     $this->middleware('siteonline');
  //     $this->middleware('views')->only('index');
  //     $this->middleware('create')->only('create', 'store');
  //     $this->middleware('edit')->only('edit', 'update');
  //     $this->middleware('delete')->only('delete');
  //     //$this->middleware('admin')->only('restore', 'destroy', 'showdalet', 'alldestroy');
  //
  // }
  public function movie($bodyApi)
  {
    $DbMovies = new New_Movies;
    $apidata = new SimoPhp;
    $movie = $apidata->ApiOneAuto($bodyApi->tmdb,"movie") ;
  //  $bodyApi = (object) $bodyApi;


    $chek = $DbMovies->where('tmdb_id', $bodyApi->tmdb)->first();
    if (!$chek) {
      $slug = $bodyApi->slug;
      $chek = $DbMovies->where('slug', $bodyApi->slug)->first();
    }
    if (!$chek && isset($movie['title']) && strlen(Str::slug($movie['title'], '-')) > 1) {
      $slug = Str::slug($movie['title'], '-');
      $chek = $DbMovies->where('slug', $slug)->first();
    }

    if (!$chek) {
      $slug = Str::slug($bodyApi->name, '-');
      $chek = $DbMovies->where('slug', $slug)->first();
    }

    if (!$chek) {
    echo "<h1>".$bodyApi->name."</h1>";
    $DbMovies->title = $movie['title']??$bodyApi->name ;
    $DbMovies->title_org = $movie['title_org']??($bodyApi->name_org??$bodyApi->name) ;
    $DbMovies->title_old = $bodyApi->title ;
    $DbMovies->type = "movies" ;
    $DbMovies->content = $bodyApi->overview??$movie['overview'] ;
    $DbMovies->slug  = $slug;
    $DbMovies->tmdb_id  = $movie['tmdb_id']??$bodyApi->tmdb ;
    $DbMovies->imdb_id  = $movie['imdb_id']??$bodyApi->imdb ;
    $dates = Carbon::now() ;
    $namedir='/'.$dates->year.'/'.$dates->month;
    $DbMovies->folder_date  = $movie['Date_folder']??$namedir ;
    $DbMovies->timestamps ;
    $DbMovies->user_id = "1" ;
    $DbMovies->save() ;
    //Auth::user()->UserMovies()->save($DbMovies);

 // start save info movies meta
 if ($DbMovies && isset($movie["info"])) {
   foreach ($movie["info"] as $key => $value) {
     $info_movie = new New_Movies_Meta ;
     $info_movie->type = "movies" ;
     $info_movie->simokey = $key ;
     $info_movie->simovalue =  $value ;
     $info_movie->user_id =  $DbMovies->user_id ;
     $DbMovies->tvdata()->save($info_movie);
   }
 }

 // end save info movies meta
     //dd($DbMovies);
     //$apidata->Categorys($request->category, 'movies', $DbMovies->id);
     if (isset($movie["genres"])) {
       $apidata->Tags($movie["genres"], 'movies', $DbMovies);
     }

    }
    return $chek ?? $DbMovies ;
  }
  public function tvshow($bodyApi)
  {
    $DbTvshows = new New_Tvshows;
    $apidata = new SimoPhp;
    $movie = $apidata->ApiOneAuto($bodyApi->tmdb,"tvshow") ;
  //  $bodyApi = (object) $bodyApi;

    $slug = Str::slug($bodyApi->name, '-');
    $chek = $DbTvshows->where('slug', $slug)->where('tmdb_id', $bodyApi->tmdb)->first();
    if (!$chek) {
      $chek = $DbTvshows->where('slug', $slug)->first();
    }
    if (!$chek) {
      $chek = $DbTvshows->where('slug', $bodyApi->slug)->first();
    }
    if (!$chek) {
      $chek = $DbTvshows->where('tmdb_id', $bodyApi->tmdb)->first();
    }

    if (!$chek) {
    echo "<h1>".$bodyApi->name."</h1>";
    $DbTvshows->title = $movie['title']??$bodyApi->name ;
    $DbTvshows->title_org = $movie['title_org']??($bodyApi->name_org??$bodyApi->name) ;
    $DbTvshows->title_old = $bodyApi->title ;
    $DbTvshows->type = strtolower($bodyApi->type) ;
    $DbTvshows->content = $bodyApi->overview??($movie['overview']??"") ;
    $DbTvshows->slug  = $slug;
    $DbTvshows->tmdb_id  = $movie['tmdb_id']??($bodyApi->tmdb??"") ;
    $DbTvshows->imdb_id  = $movie['imdb_id']??($bodyApi->imdb??"") ;
    $dates = Carbon::now() ;
    $namedir='/'.$dates->year.'/'.$dates->month;
    $DbTvshows->folder_date  = $movie['Date_folder']??$namedir ;
    $DbTvshows->timestamps ;
    $DbTvshows->user_id = "1" ;
    $DbTvshows->save() ;
    //Auth::user()->UserMovies()->save($DbTvshows);

 // start save info movies meta
 if ($DbTvshows && isset($movie["info"])) {
   foreach ($movie["info"] as $key => $value) {
     $info_movie = new New_TvShows_Meta ;
     $info_movie->type = "tvshows" ;
     $info_movie->simokey = $key ;
     $info_movie->simovalue =  $value ;
     $info_movie->user_id =  $DbTvshows->user_id ;
     $DbTvshows->tvdata()->save($info_movie);
   }
 }

 // end save info movies meta
     //dd($DbMovies);
     //$apidata->Categorys($request->category, 'movies', $DbMovies->id);
     if (isset($movie["genres"])) {
       $apidata->Tags($movie["genres"], 'tvshows', $DbTvshows);
     }

    }
    return $chek ?? $DbTvshows ;
  }

  public function season($DbMovies,$movie)
  {
  //$movie = (object) $movie;
    $apidata = new SimoPhp;
    $moviee = $apidata->ApiOneAuto($movie->tmdb,"season",$movie->season) ;
    $Seasons = new Seasons;
    $name = ($movie->name).' Season '.($movie->season);
    $slug = Str::slug($name, "-");
    $chek = $Seasons->where('tv_id', $DbMovies->id)
                    //->where('season_nm', $seasons->season_nm)
                    ->where('slug', $slug)
                  //  ->orWhere('slug', $slug)
                    ->first();
    if (!$chek) {
      $chek = $Seasons
                      //->where('season_nm', $seasons->season_nm)
                      ->where('slug', $movie->slug)
                    //  ->orWhere('slug', $slug)
                      ->first();
    }
    if (!$chek) {
      $chek = $Seasons
                      //->where('season_nm', $seasons->season_nm)
                      ->where('slug', $slug)
                    //  ->orWhere('slug', $slug)
                      ->first();
    }
    // if (!isset($chek)) {
    //   $name = ($movie->name_org).' Season '.$movie->season;
    //   $chek = $Seasons->where('tv_id', $DbMovies->id)
    //                   //->where('season_nm', $seasons->season_nm)
    //                   ->where('slug', $slug)
    //                   //->orWhere('slug', $slug)
    //                   ->first();
    // }

  if (!isset($chek)) {
    $Seasons->tv_id = $DbMovies->id;
    $Seasons->name = $name??$moviee['title'] ;
    $Seasons->title_old = $movie->title ;
    $Seasons->slug = $slug ;
    $Seasons->overview = $moviee["overview"]??($movie->title??$movie->name);
    $Seasons->name_season = 'Season '.($moviee["season_nm"]??$movie->season);
    $Seasons->name_tvshow = $DbMovies->title_org??($movie->name_org??$movie->name);
    $Seasons->season_nm = $moviee["season_nm"]??$movie->season ;
    $Seasons->first_date = $moviee["first_date"]??"";
    $Seasons->episode_nm = $moviee["episode_nm"]??"";
    $Seasons->tmdb_id = $DbMovies->tmdb_id;
    $images = $moviee["postimg"]??null ;
    if (isset($images) && strlen($Seasons->post_img) == 0) {
      $Seasons->post_img = $moviee["postimg"] ;
    }
    $dates = Carbon::now() ;
    $namedir='/'.$dates->year.'/'.$dates->month;
    $Seasons->folder_date  = $moviee['Date_folder']??$namedir ;
    $Seasons->user_id = "1" ;
    $Seasons->save() ;
  //  Auth()->user()->UserSeasons()->save($Seasons);
// end save info movies meta
   //dd($DbMovies);
  }
    return $chek ?? $Seasons ;
  }

  public function episode($seasons,$movie)
  {
    if (isset($movie)) {
    //$movie = (object) $movie;
    $apidata = new SimoPhp;
    $DbTVshows = new Episodes;
    $name = ($movie->name).' Season '.($movie->season).' Episode '.($movie->episode);
    $slug = Str::slug($name, "-");
    $chek= $DbTVshows
           ->where('sea_id', $seasons->id)
        //   ->where('season_nm', $seasons->season_nm)
           ->where('episode_nm', intval($movie->episode))
        //   ->where('slug', $slug)
        //   ->orWhere('slug', $slug)
        //   ->where('episode_nm', intval($movie->episode))
           ->first() ;
   //
   // if (!$chek) {
   //   $chek= $DbTVshows
   //          ->where('slug', $slug)
   //          ->first() ;
   // }
  $moviee = $apidata->ApiOneAuto(($movie->tmdb??($chek->tmdb_id??null)),"episode",($movie->season??$chek->season_nm),$movie->episode) ;
   if (!isset($chek)) {

   $DbTVshows->name = $name;
   $DbTVshows->title_old = $movie->name;
   $DbTVshows->slug = $slug;
   $DbTVshows->overview = $moviee['overview']??($movie->title??$movie->name);
   $DbTVshows->name_season = $seasons->name_season;
   $DbTVshows->name_episode = $moviee['title']??('Episode '.intval($movie->episode));
   $DbTVshows->name_tvshow = $seasons->name_tvshow ;
   $DbTVshows->first_date = $moviee['first_date']??"";
   $DbTVshows->season_nm = $seasons->season_nm ;
   $DbTVshows->episode_nm = $moviee['episode_nm']??intval($movie->episode) ;
   $DbTVshows->rating = $moviee['rating']??"" ;
   $DbTVshows->vote_count = $moviee['vote_count']??"" ;
   $images = $moviee["postimg"]??null ;
   if (isset($images) && strlen($DbTVshows->post_img) == 0) {
    $DbTVshows->post_img = $moviee['postimg'];
   }
   $DbTVshows->tv_id = $seasons->tv_id;
   $DbTVshows->sea_id = $seasons->id;
   $dates = Carbon::now() ;
   $namedir='/'.$dates->year.'/'.$dates->month;
   $DbTVshows->folder_date = $moviee['Date_folder']??$namedir;
   $DbTVshows->tmdb_id = $seasons->tmdb_id;
   $DbTVshows->user_id = "1" ;
   $DbTVshows->save() ;
  // Auth()->user()->UserEpisodes()->save($DbTVshows);
   }
   return $chek ?? $DbTVshows ;
      }
  }

    public function tvshows($page)
    {
    //  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

      // $request = new Request ;
      $link = "http://filmoq.md/00.json" ;
      //$link = "http://filmoq.md/autofix/tvshows?page=".($page??1) ;
      $body = Http::get($link)->body() ;

      $body_Api = json_decode($body);
dd($body_Api);

      if (isset($body_Api) && count($body_Api->data) > 0) {
        $page_end = $body_Api->pages ;
        echo "<h1>".$page_end." === ".$page."</h1>";
        //////////////////////////////////
        $dates = Carbon::now() ;
        $namedir='/'.$dates->year.'/'.$dates->month;
        /////////////////////////////

        foreach ($body_Api->data as $key => $value) {
          $DbTvshows = new New_Tvshows;
          $apidata = new SimoPhp;
          $bodyApi = $value ;
          $slug = Str::slug($bodyApi->name, '-');
          $chek = $DbTvshows->where('slug', $slug)->where('tmdb_id', $bodyApi->tmdb)->first();
          if (!$chek) {
            $slug = Str::slug($bodyApi->name."-".$bodyApi->name, '-');
            $chek = $DbTvshows->where('slug', $slug)->first();
          }
          if (!$chek) {
              echo "<h1>".$bodyApi->name."</h1>";
              $DbTvshows->title = $bodyApi->name;
              $DbTvshows->title_org = $bodyApi->name_org??"";
              $DbTvshows->type = strtolower($bodyApi->type);
              $DbTvshows->content = $bodyApi->overview??"";
              $DbTvshows->slug  = $slug;
              $DbTvshows->tmdb_id  = $bodyApi->tmdb??"";
              $DbTvshows->imdb_id  = $bodyApi->imdb??"";
              $DbTvshows->folder_date  = $namedir;
              $DbTvshows->timestamps;
              $DbTvshows->user_id = "1" ;
              $DbTvshows->save() ;
            //  Auth::user()->Usertvshows()->save($DbTvshows);
          }
        }

        if ($DbTvshows && $page_end >= $page??1)
           {
          //  header('Refresh: 1; URL='.$Tv_Shows->nextPageUrl());
          $pages = 1 + ($page??1) ;
          header('Refresh: 1; URL='.url('autofix/tvshows/'.$pages));
         //  header('Refresh: 1; URL='.url('admin/server/runtverror'));
          exit;
          }
      }else {
        header('Refresh: 1; URL='.url('autofix/tvshows/'.$page));
        exit;
      }
dd($DbTvshows);

    }
    public function seasons($page,$pagenm)
    {
      //MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      // $request = new Request ;
      $api = new SimoPhp;
      //$link = "http://filmoq.md/00.json"pagenm ;
//http://filmoq.md/storage/tvshows/1/0.json
     $url= "http://filmoq.md/autofix/tvshows?page=".($page??1) ;
     $body = Http::get($url)->body() ;
     $body_all = json_decode($body);
     $datatv = $this->tvshow($body_all->datatv) ;
    //   for ($i=0; $i <= ($body_Api->seasons-1) ; $i++) {
       $link = "http://filmoq.md/storage/tvshows/".($page??1)."/".$pagenm.".json" ;
       $body = Http::get($link)->body() ;
       $body_Api = json_decode($body);
       // start season
        $dataSeason = $this->season($datatv,$body_Api->seasons) ;
        foreach ($body_Api->episodes as $ep => $episode) {
        // start episode nm
     $episode0 = [] ;
      foreach ($episode as $eps => $ep_detai) {

      $dataEpisode = $this->episode($dataSeason,$ep_detai) ;

      //detail server star
      if (isset($ep_detai->data)) {
        $servers = json_decode($ep_detai->data,true) ;
        $apidata = new SimoPhp;
        if (isset($servers["players"])) {
        $apidata->serversdb($servers["players"],$dataEpisode,'episode','player_encodes');
        }

        if (isset($servers["downloads"])) {
        $apidata->serversdb($servers["downloads"],$dataEpisode,'episode','download_encodes');
        }

      }

  // $episode0[] = ["episode" => $ep_detai["episode"] , "servers" => $ep_detai["servers"]] ;
            }
  // $episodes[] = $episode0 ;
        }

       if ($pagenm == (int)($body_all->seasons)-1) {
         if (intval(($body_all->pages-1)) >= intval($page)){
           header('Refresh: 1; URL='.url('admincp/autofix/seasons/'.($page+1).'/0'));
         }
       }else {
         echo "<h1>".$page."</h1><br>";
         if (intval(($body_all->seasons-1)) >= intval($pagenm)){
           header('Refresh: 1; URL='.url('admincp/autofix/seasons/'.$page.'/'.($pagenm+1)));
         }
       }
    // }






      //dd($body_Api->datatv);
    //  rsort($body_Api["data"]);
//
//       foreach ($body_Api->data as $sea => $season) {
//       // start season
//       $dataSeason = $this->season($datatv,$season->seasons) ;
//     //  $episodes = [] ;
//       // start episode
//       foreach ($season->episodes as $ep => $episode) {
//       // start episode nm
// //    $episode0 = [] ;
//     foreach ($episode as $eps => $ep_detai) {
//     $dataEpisode = $this->episode($dataSeason,$ep_detai) ;
//
//     //detail server star
//     if (isset($ep_detai->data)) {
//       $servers = json_decode($ep_detai->data,true) ;
//       $apidata = new SimoPhp;
//       if (isset($servers["players"])) {
//       $apidata->serversdb($servers["players"],$dataEpisode,'episode','player_encodes');
//       }
//
//       if (isset($servers["downloads"])) {
//       $apidata->serversdb($servers["downloads"],$dataEpisode,'episode','download_encodes');
//       }
//
//     }
//
// // $episode0[] = ["episode" => $ep_detai["episode"] , "servers" => $ep_detai["servers"]] ;
//           }
// // $episodes[] = $episode0 ;
//       }
// // $seasonall[] = [$season["seasons"],$episodes] ;
//       }

// dd($body_Api);
      //return $body ;
    }
    function movies($page)
    {
    //  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      // $request = new Request ;
      $api = new SimoPhp;
      $link = "http://filmoq.md/autofix/movies?page=".($page??1) ;
      //$link = "http://filmoq.md/00.json" ;
      $body = Http::get($link)->body() ;
        //  return $body ;
      $body_Api = json_decode($body);
      $datatv = $this->movie($body_Api->datatv) ;
      foreach ($body_Api->data as $key => $value) {

            if (isset($value)) {
              $array = (array)$value ;
              $servers = json_decode(array_shift($array),true) ;
              $apidata = new SimoPhp;

              if (isset($servers["players"])) {
              $apidata->serversdb($servers["players"],$datatv,'movies','player_encodes');
              }

              if (isset($servers["downloads"])) {
              $apidata->serversdb($servers["downloads"],$datatv,'movies','download_encodes');
              }

            }
      }

      echo "<h1>".$page."</h1><br>";
      if (intval($body_Api->pages) >= intval($page)){
        header('Refresh: 1; URL='.url('/admincp/autofix/movies/'.($page+1)));
      }


    }
}
