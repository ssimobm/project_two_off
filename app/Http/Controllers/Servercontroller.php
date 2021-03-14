<?php

namespace App\Http\Controllers;
use App\Models\New_Movies;
use Auth;
use App\Models\New_Tvshows;
use App\Models\Seasons;
use App\Models\TVMeta;
use App\Models\Options;
use Illuminate\Http\Request;

class Servercontroller extends Controller
{

     public function tv_ep_index($tv, $Sea, $Ep)
     {
       $DbMovies = New_Tvshows::where('slug', $tv)->firstOrFail();
       $vistor = (new \App\MyClass\SimoPhp)->GetVisitor(Request(),$DbMovies,'episodes',$DbMovies->id) ;

       $Data = $DbMovies->tvdata;
       $Seasons = $DbMovies->Seasons->where('season_nm', $Sea)->first() ;
       $Episodes = $Seasons->episode->where('episode_nm', $Ep)->first();
       if (!isset($Episodes)) {
         return redirect()->back();
       }
       $SeoAll = new \App\MyClass\SimoPhp("Seo_Episodes",$Episodes->name??"") ;
       $Seo = $SeoAll->seo_meta() ;

 return view('sites.Episodes.home',["Seo" => $Seo,"Episode" => $DbMovies,"Data" => $Data, "Seasons" => $Seasons ,"Episodes" => $Episodes ,]);
       }
       public function season_ep_index($tv, $Sea, $Ep)
       {
         $DbMovies = Seasons::where('tvshow_slug', $tv)->where('season_nm', $Sea)->firstOrFail();
  
        $vistor = (new \App\MyClass\SimoPhp)->GetVisitor(Request(),$DbMovies,'episodes',$DbMovies->id) ;

         $Seasons = $DbMovies ;
         $Episodes = $Seasons->episode->where('episode_nm', $Ep)->first();

         if (!isset($Episodes)) {
           return redirect()->back();
         }
         $SeoAll = new \App\MyClass\SimoPhp("Seo_Episodes",$Episodes->name??"") ;
         //$Seasons->name.__('Episode').$Episodes->episode_nm
         $Seo = $SeoAll->seo_meta() ;

   return view('sites.Episodes.home_season',["Seo" => $Seo,"Seasons" => $Seasons ,"Episodes" => $Episodes ,]);
         }
     // public function ep_index($id)
     // {
     //   $DbMovies = New_Movies::where('type', 'tvshows')->where('slug', $id)->firstOrFail();
     //   $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);
     //   return view('Episodes.profile',["movies" => $DbMovies,"Data" => $Data,"comments" => $comments,]);
     // }
}
