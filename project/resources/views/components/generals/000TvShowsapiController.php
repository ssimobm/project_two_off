<?php

namespace App\Http\Controllers\autofix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Models\Episodes;
use App\Models\Servers;
use App\Models\Servers_En;
use App\Models\Tv_Shows;
use App\Models\DataTv;
use App\Models\DataSeason;
use App\MyClass\ApiSimo;
use Illuminate\Support\Facades\DB;
class 000TvShowsapiController extends Controller
{
    public function tvshows()
    {
      $datatvdb = new DataTv ;
      $datatv = $datatvdb->paginate(1) ;
    //  dd($datatv->first()->dataseason);
      $seasons_org = [] ;
      return response()->json(['datatv' => $datatv->first()->getAttributes(), 'seasons' =>  $datatv->first()->dataseason->count() ,'pages' => $datatv->lastPage()]) ;
    }

    public function season()
    {

      $datatvdb = new DataTv ;
      $datatv = $datatvdb->paginate(1) ;
    //  dd($datatv->first()->dataseason);
      $seasons_org = [] ;
      foreach ($datatv->first()->dataseason as $key => $value) {
      //season Start
      $seasons = [] ;
      foreach ($value->tvshows as $sea => $season) {
      //episode Start
      $episodes = [] ;
      foreach ($season->episodes as $ep => $episode) {
      $episodes[$sea.'-'.$ep] = $episode->serversen ;
        }

      $seasons[$sea] = $episodes ;
      }
       $seasons_org = ["seasons" => $value, "episodes" => $seasons] ;
       Storage::disk('public')->put('tvshows/'.$datatv->currentPage().'/'.$key.'.json', json_encode($seasons_org));

      }
  //    Storage::disk('public')->put('tvshows/tvshows_animes.json', json_encode($seasons_org));
//      return response()->json(['datatv' => $datatv->first(), 'data' => $seasons_org, 'pages' => $datatv->lastPage()]) ;
echo "<h1>".$datatv->currentPage()."</h1><br>";
if ($datatv->lastPage() >= $datatv->currentPage()){
  header('Refresh: 1; URL='.$datatv->nextPageUrl());
}
    }
//     public function season()
//     {
//       $api = new ApiSimo ;
// //       $datatvdb = new DataSeason ;
// //       $datatv = $datatvdb->paginate(1)->first() ;
// //
// //       foreach ($datatv->tvshows as $sea => $season) {
// //         $Name = $api->filterAll('season',($season->title." siend")) ;
// //         echo $season->title." season ".$season->season."(".$season->episodes->count().")<br>" ;
// //       }
// //
// //
// // dd($datatv->tvshows);
//       $datatvdb = new DataTv ;
//       $datatv = $datatvdb->paginate(1)->first() ;
//       $seasons_org = [] ;
//       foreach ($datatv->dataseason as $key => $value) {
//       echo "<h1>".$value->name."</h1>" ;
//       //season Start
//       $seasons = [] ;
//       foreach ($value->tvshows as $sea => $season) {
//
//       echo $season->name." season ".$season->season."(".$season->episodes->count().")<br>" ;
//       //episode Start
//       $episodes = [] ;
//       echo "<ul>";
//       foreach ($season->episodes as $ep => $episode) {
//       echo "<li>".$episode->name." season ".$episode->season."</li>" ;
//       //server Start
//       $servers = [] ;
//       echo "<ul>";
//       foreach ($episode->serversen as $ser => $server) {
//       $servers[] = $server->data ;
//       echo "<li>".$server->data."</li>" ;
//     //  dd($server);
//       }
//       $episodes[] = ["episode" => $episode,  "servers" => $servers,] ;
//       echo "</ul>";
//       //dd($episode);
//         }
//       $seasons[] = [$episodes] ;
//       echo "</ul>";
//       }
//
//       $seasons_org["season_all"] = ["seasons" => $value, "episodes" => $seasons] ;
//       }
// dd($seasons_org["season_all"]);
//     //  return response()->json(['data' => $datatv->all(), 'pages' => $datatv->lastPage()]) ;
//     }
}
