<?php

namespace App\Http\Controllers\AdminCp\Admin\Data;
use App\Http\Controllers\Controller;

use Storage;
use Carbon\Carbon;
use App\Models\Episodes;
use App\Models\Categorys;
use App\Models\Servers;
use App\Models\Likes;
use App\Models\User;
use Validator;
use Auth;
use App\Models\Seasons;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;
use App\MyClass\MyFunction;
use App\MyClass\SimoPhp;

class EpisodesControl extends Controller
{


  public function __construct(User $user)
  {
    $this->middleware('admin');
    $this->middleware('siteonline');
    $this->middleware('views')->only('index') ;
    $this->middleware('create')->only('create','store') ;
    $this->middleware('edit')->only('edit','update') ;
    $this->middleware('delete')->only('delete') ;
    $this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');

  //  $this->middleware('siteonline');
  //  $this->middleware('users');->only('create') ;

       //$this->middleware('admin');
       //$this->middleware('editor');
        //  $this->middleware('throttle:3,1');

  //  $this->middleware('can:Editor_Ep,App\Models\User');
//MyFunction::authorizes(['Editor_Ep']);
    //MyFunction::permission(['create'], $user);



  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
//  $simoo=Episodes::orderByRaw('LENGTH(Ep_Nm)', 'ASC')->orderBy('Ep_Nm', 'ASC')->simplePaginate(12);
$simoo=Episodes::Paginate(12);

return view('admincp.Episodes.index',["data" => $simoo]);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tv ,$season)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
$Seasons = Seasons::find($season);
$quality = Categorys::get();
        return view('admincp.Episodes.Adds',["tv" => $tv, "season" => $Seasons , "Quality" => $quality ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $tv , $season)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

$seasons = Seasons::find($season);
$DbTVshows = new Episodes;
$check = $DbTVshows->where('tv_id', $tv)
                   ->where('sea_id', $seasons->id)
                   ->where('episode_nm', $request->nm_episode)
                   ->first();

$dates = Carbon::now() ;
$namedir= $dates->year.'/'.$dates->month;

if (!isset($check->id) && $request->Submit === "data") {

$DbTVshows->tv_id = $tv;
$DbTVshows->sea_id = $season;
$DbTVshows->name = $request->title_Add;
$DbTVshows->slug = Str::slug($DbTVshows->name , "-");
$DbTVshows->overview = $request->editor."";
$DbTVshows->name_season = $seasons->id;
$DbTVshows->name_episode = $request->title_episode;
$DbTVshows->name_tvshow = $request->title_tv ;
$DbTVshows->tmdb_id = $request->id_Tmdb;
$DbTVshows->first_date = $request->DateFirst;
$DbTVshows->season_nm = $request->nm_season ;
$DbTVshows->episode_nm = $request->nm_episode ;
$DbTVshows->folder_date = $namedir;
if (isset($request->addPhoto)) {

$request->validate([
'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);
$request->file('addPhoto')->storeAs('public/images/'.$DbTVshows->folder_date,$request->addPhoto->getClientOriginalName());
$DbTVshows->post_img = $DbTVshows->folder_date.'/'.$request->addPhoto->getClientOriginalName() ;

}else {
$DbTVshows->post_img = '' ;
}
Auth()->user()->UserEpisodes()->save($DbTVshows);
$apidata = new SimoPhp;
$apidata->Categorys($request->quality, 'episodes', $DbTVshows->id,"Quality");
}

   $id = $check->id??$DbTVshows->id;
   return redirect('episodes/edit/'.$id)->with('status', 'Profile updated!');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit($episode)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

        $DbTVshows = Episodes::where('id', $episode)->first();
        $quality = Categorys::where('taxonomy', 'Quality')->get();
        return view('admincp.Episodes.Edit',["Episode" => $DbTVshows,"Quality" => $quality,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $season , $ep)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

      $seasons = Seasons::find($season);
      $DbTVshows = Episodes::find($ep);
      $check = $DbTVshows->id;

      if (isset($check)) {

      $DbTVshows->name = $request->title_Add;
      $DbTVshows->slug = Str::slug($DbTVshows->name , "-");
      $DbTVshows->overview = $request->editor."";
      $DbTVshows->name_season = $seasons->name_season;
      $DbTVshows->name_episode = $request->title_episode;
      $DbTVshows->name_tvshow = $request->title_tv ;
      $DbTVshows->tmdb_id = $request->id_Tmdb;
      $DbTVshows->first_date = $request->DateFirst;
      $DbTVshows->season_nm = $request->nm_season ;
      $DbTVshows->episode_nm = $request->nm_episode ;

      if (isset($request->addPhoto)) {

      $request->validate([
      'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      $request->file('addPhoto')->storeAs('public/images/'.$DbTVshows->folder_date,$request->addPhoto->getClientOriginalName());
      $DbTVshows->post_img = $DbTVshows->folder_date.'/'.$request->addPhoto->getClientOriginalName() ;

      }else {
      $DbTVshows->post_img = '' ;
      }

      Auth()->user()->UserEpisodes()->save($DbTVshows);

      }

      $apidata = new SimoPhp;
      if (isset($request->quality)) {
      $apidata->Categorys($request->quality, 'episodes', $DbTVshows->id,"Quality");
      }

      $apidata->serversdb($request->player,$DbTVshows,'episode','player');
      $apidata->serversdb($request->download,$DbTVshows,'episode','download');
/////////////////////////////////////////////////////////////
return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
     public function server_delet(Request $request , $episode)
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

       $user1 = Servers::Where('id' ,$episode)->firstOrFail();
       $user1->delete();
       $user1->forceDelete();

     }
    public function delete($episode)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

      $user1 = Episodes::Where('id' ,$episode)->firstOrFail();
      $user1->server()->where('type', 'episode')->delete();
      $user1->delete();
      return back();

    }
    public function restore($episode)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
      $user1 = Episodes::onlyTrashed()->Where('id' ,$episode)->firstOrFail();
      $user1->server()->where('type', 'episode')->restore();
      $user1->restore();
      return back();
    }
    public function destroy($episode)
    {

      MyFunction::authorizes(['AdmincpSuper','Admincp']);
      $user1 = Episodes::onlyTrashed()->Where('id' ,$episode)->firstOrFail();
      $user1->forceDelete();
      $user1->server()->where('type', 'episode')->forceDelete();
      return back();

    }
    public function showdalet()
      {

        MyFunction::authorizes(['AdmincpSuper','Admincp']);
        $user1 = Episodes::onlyTrashed()->simplePaginate(12);
        return view('admincp.Episodes.Trashed',["data" => $user1]);

      }






}
