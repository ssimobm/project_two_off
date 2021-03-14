<?php

namespace App\Http\Controllers\AdminCp\Admin\Data;
use App\Http\Controllers\Controller;

use Storage;
use Carbon\Carbon;
use App\Models\Season;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\TV;
use App\Models\User;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;
use App\MyClass\MyFunction;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(User $user)
     {
      $this->middleware('auth');
      $this->middleware('admin');
      $this->middleware('siteonline');
      $this->middleware('views')->only('index') ;
      $this->middleware('create')->only('create','store') ;
      $this->middleware('edit')->only('edit','update') ;
      $this->middleware('delete')->only('delete') ;
      //$this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');



          //$this->middleware('admin');
          //$this->middleware('editor');
           //  $this->middleware('throttle:3,1');

     //  $this->middleware('can:Editor_Ep,App\Models\User');
     //MyFunction::authorizes(['Editor_Ep']);
       //MyFunction::permission(['create'], $user);



     }

public function index()
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
$simoo=Seasons::Paginate(12);

  return view('admincp.Seasons.index',["data" => $simoo]);
}


    public function create($seasons)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
$tv = Tvshows::find($seasons) ;
        return view('admincp.Seasons.Adds',["id" => $seasons,"tv" => $tv]);
    }

    public function edit($season)
    {
        MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $Seasons = Seasons::find($season);
        //$this->authorize('update', $Seasons);

        return view('admincp.Seasons.Edit',["season" => $Seasons,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $season)
    {

      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
            if ($request->Submit === "data") {
              $DbTVshows = Seasons::find($season);
              $DbTVshows->tv_id = $DbTVshows->id;
              $DbTVshows->name = $request->addTiltle;
              $DbTVshows->slug = Str::slug($request->slug , "-");
              $DbTVshows->overview = $request->editor."";
              $DbTVshows->name_season = $request->title_season;
              $DbTVshows->name_tvshow = $request->title_tv ;
              $DbTVshows->episode_nm = $request->CountEp ;
              $DbTVshows->tmdb_id = $request->id_Tmdb;
              $DbTVshows->first_date = $request->DateFirst;
              $DbTVshows->season_nm = $request->NemSea ;
              if (isset($request->addPhoto)) {

              $request->validate([
              'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ]);
              $request->file('addPhoto')->storeAs('public/images/'.$DbTVshows->folder_date,$request->addPhoto->getClientOriginalName());
              $DbTVshows->Postimg = $DbTVshows->folder_date.'/'.$request->addPhoto->getClientOriginalName() ;

              }
              $DbTVshows->save();
            }// end if data

        return back() ;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function delete($season)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $user1 = Seasons::Where('id' ,$season)->firstOrFail();
      $user1->delete();
      return back();
    }
    public function restore($season)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $user1 = Seasons::onlyTrashed()->Where('id' ,$season)->firstOrFail();
      $user1->restore();
      return back();
    }
    public function destroy($season)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
      $user1 = Seasons::onlyTrashed()->Where('id' ,$season)->firstOrFail();
      $user1->forceDelete();
      return back();


    }
    public function showdalet()
      {
        MyFunction::authorizes(['AdmincpSuper','Admincp']);
        $user1 = Seasons::onlyTrashed()->simplePaginate(12);
      return view('admincp.Seasons.Trashed',["data" => $user1]);


      }






}
