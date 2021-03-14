<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\New_Tvshows;
use App\Models\New_Tvshows_Meta;
use App\Models\Tvshows;
use App\Models\Seasons;
use App\Models\TVMeta;
use App\Models\Options;

use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;


class ProfileTVshowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $Tvshows = New_Tvshows::where('slug', $id)->firstOrFail() ;
      $vistor = (new \App\MyClass\SimoPhp)->GetVisitor(Request(),$Tvshows,'tvshows',$Tvshows->id) ;

      $SeoAll = new \App\MyClass\SimoPhp("Seo_TvShows",$Tvshows->title) ;
      $Seo = $SeoAll->seo_meta() ;
      $simo=$Tvshows->Seasons->sortBy('season_nm');
      if (count($simo)>0) {
        foreach ($simo as $key => $value) {
        $id= $simo[$key]->id;

        $link[] = ['Seo' => $Seo ,'season_nm' => $simo[$key]->season_nm,'name' => $simo[$key]->name_season,'ep' => $simo->where('id', $id)->first()->episode->where('sea_id', $id)->sortBy('episode_nm')->all(),];
        }
      }else {
        $link=$simo;
      }
      $tvdata = $Tvshows->tvdata ;
      $arrayName = array('Seo' => $Seo ,'Tv' =>$Tvshows ,'tvdata' =>$tvdata ,'data_se_ep' => $simo, "link" => $link);
      return  View('sites.tvshows.Profile',$arrayName);
    }
    public function seasons($season,$id=null)
    {
      if (isset($id)) {
        $Tvshows = Seasons::where('tvshow_slug', $season)->where('season_nm', $id)->firstOrFail() ;
      }else {
        $Tvshows = Seasons::where('slug', $season)->firstOrFail() ;
      }

      $vistor = (new \App\MyClass\SimoPhp)->GetVisitor(Request(),$Tvshows,'tvshows_season',$Tvshows->id) ;

      $SeoAll = new \App\MyClass\SimoPhp("Seo_TvShows",$Tvshows->title) ;
      $Seo = $SeoAll->seo_meta() ;
      $link=$Tvshows->episode->sortBy('episode_nm')->all();

      $arrayName = array('Seo' => $Seo ,'tvshow' => $Tvshows ,"link" => $link);
      return  View('sites.tvshows.seasons',$arrayName);
    }
}
