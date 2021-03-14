<?php

namespace App\Http\Controllers;
use Storage;
use Carbon\Carbon;
use App\Models\Season;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\TV;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;
class SeasonsController extends Controller
{
    
public function index()
{
$simoo=Seasons::simplePaginate(12);

  return view('Seasons.index',["data" => $simoo]);
}


    public function create($seasons)
    {
        $tv = Tvshows::find($seasons) ;
        return view('Seasons.Adds',["id" => $seasons,"tv" => $tv]);
    }
  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit($season)
    {
        $Seasons = Seasons::find($season);
        $this->authorize('update', $Seasons);
        return view('Seasons.Edit',["season" => $Seasons,]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function delete($season)
    {
      $user1 = Seasons::Where('id' ,$season)->firstOrFail();
      $user1->delete();
      return back();
    }
    public function restore($season)
    {
      $user1 = Seasons::onlyTrashed()->Where('id' ,$season)->firstOrFail();
      $user1->restore();
      return back();
    }
    public function destroy($season)
    {
      $user1 = Seasons::onlyTrashed()->Where('id' ,$season)->firstOrFail();
      $user1->forceDelete();
      return back();


    }
    public function showdalet()
      {
      $user1 = Seasons::onlyTrashed()->simplePaginate(12);
      return view('Seasons.Trashed',["data" => $user1]);


      }






}
