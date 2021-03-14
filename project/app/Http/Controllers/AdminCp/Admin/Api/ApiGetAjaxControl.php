<?php


namespace App\Http\Controllers\AdminCp\Admin\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\MyClass\MyFunction;
use App\Models\Categorys;
use App\Models\CategorysMeta;
use App\Models\New_TvShows;
use App\Models\New_Movies;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\TVMeta;
use App\Models\Options;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class ApiGetAjaxControl extends Controller
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

public function tvshows_ajax($id=1)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $TvShows = New_TvShows::get() ;
 $Options = new MyClass2 ;
 $Options->DB='App\Models\Options' ;
 $Options->Value='option_value' ;
 $link = "https://api.themoviedb.org/3/tv/popular";
 $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;
 $link = Http::get($linkpatch)->body();
 $link_body = json_decode($link)->results ;

 return view(($id != 1)?'admincp.apidata.ajax' : 'admincp.apidata.index' , ['data' => $link_body, 'Tvshows'=> $TvShows,]);


}

public function movies_ajax($id=1)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Movies = New_Movies::get() ;
 $Options = new MyClass2 ;
 $Options->DB='App\Models\Options' ;
 $Options->Value='option_value' ;
 $link = "https://api.themoviedb.org/3/movie/popular";
 $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;
 $link = Http::get($linkpatch)->body();
 $link_body = json_decode($link)->results ;

 return view(($id != 1)?'admincp.apidata.Movies.m_ajax' : 'admincp.apidata.Movies.m_index' , ['data' => $link_body, 'Movies'=> $Movies,]);


}

public function seasons_ajax($tv=null)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

$TvShows = new New_TvShows ;

if (!isset($tv)) {
  $tv= $TvShows->Paginate(12);
  return view('admincp.apidata.Seasonss.s_index',["data" => $tv]);
}
$TvShows = $TvShows->findOrFail($tv) ;
if (isset($tv)) {

  $Seasons = Seasons::get() ;
  $Options = new MyClass2 ;
  $Options->DB='App\Models\Options' ;
  $Options->Value='option_value' ;

  $link = "https://api.themoviedb.org/3/tv/";
  $linkpatch = $link.''.$TvShows->tmdb_id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
  $link = Http::get($linkpatch)->body();
  $link_body = json_decode($link) ;
  return view('admincp.apidata.Seasonss.s_index1' , ['data' => $link_body, 'Seasons'=> $Seasons, 'TvShows' => $TvShows ,]);
}
// end isset
}

public function episodes_ajax($tv=null , $season=null)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Seasons= new Seasons ;
 if (!isset($tv) or !isset($season)) {
   $Seasons= $Seasons->Paginate(12);
   return view('admincp.apidata.Episodes.s_index',["data" => $Seasons]);
 }
 $Seasons = $Seasons->findOrFail($season) ;
 if (isset($tv) and isset($season)) {
   $Episodes = Episodes::get() ;
   $Options = new MyClass2 ;
   $Options->DB='App\Models\Options' ;
   $Options->Value='option_value' ;
   $link = "https://api.themoviedb.org/3/tv/";
   $linkpatch = $link.''.$Seasons->tmdb_id.'/season/'.$Seasons->season_nm."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
   $link_body = Http::get($linkpatch)->body();
   $link_body = json_decode($link_body)->episodes ;
   return view('admincp.apidata.Episodes.s_index1' , ['data' => $link_body, 'Episodes'=> $Episodes, 'Seasons' => $Seasons ,]);

 }
// end isset
}
//--------------------------
// edit all api data
//--------------------------

public function episodes_ajax_edit($tv=null , $season=null)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Seasons= new Seasons ;
 if (!isset($tv) or !isset($season)) {
   $Seasons= $Seasons->Paginate(12);
   return view('admincp.apidata.Episodes.s_index',["data" => $Seasons]);
 }
 $Seasons = $Seasons->findOrFail($season) ;
 if (isset($tv) and isset($season)) {
   $Episodes = Episodes::get() ;
   $Options = new MyClass2 ;
   $Options->DB='App\Models\Options' ;
   $Options->Value='option_value' ;
   $link = "https://api.themoviedb.org/3/tv/";
   $linkpatch = $link.''.$Seasons->tmdb_id.'/season/'.$Seasons->season_nm."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
   $link_body = Http::get($linkpatch)->body();
   $link_body = json_decode($link_body)->episodes ;
   return view('admincp.apidata.Episodes.ep_edit' , ['data' => $link_body, 'Episodes'=> $Episodes, 'Seasons' => $Seasons ,]);

 }
// end isset
}
public function seasons_ajax_edit($tv=null)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

$TvShows = new New_TvShows ;

if (!isset($tv)) {
  $tv= $TvShows->Paginate(12);
  return view('admincp.apidata.Seasonss.ep_edit',["data" => $tv]);
}
$TvShows = $TvShows->findOrFail($tv) ;
if (isset($tv)) {

  $Seasons = Seasons::get() ;
  $Options = new MyClass2 ;
  $Options->DB='App\Models\Options' ;
  $Options->Value='option_value' ;

  $link = "https://api.themoviedb.org/3/tv/";
  $linkpatch = $link.''.$TvShows->tmdb_id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
  $link = Http::get($linkpatch)->body();
  $link_body = json_decode($link) ;
  return view('admincp.apidata.Seasonss.sea_edit' , ['data' => $link_body, 'Seasons'=> $Seasons, 'TvShows' => $TvShows ,]);
}
// end isset
}

public function tvshows_ajax_edit($id=1)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $TvShows = New_TvShows::where('type', 'tvshows_animes')->paginate(24) ;
 $Options = new MyClass2 ;
 $Options->DB='App\Models\Options' ;
 $Options->Value='option_value' ;
 $link_body = [] ;
 foreach ($TvShows->all() as $key => $value) {
   $link = "https://api.themoviedb.org/3/tv/".$value->tmdb_id;
   $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang');
   $body = Http::get($linkpatch)->body() ;
   $link_body[] = json_decode($body);
 }

 return view(($id != 1)?'admincp.apidata.tv_edit' : 'admincp.apidata.tv_edit' , ['data' => $link_body, 'Tvshows'=> $TvShows,]);


}
public function movies_ajax_edit($id=1)
{
  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Movies = New_Movies::Paginate(12) ;
 $Options = new MyClass2 ;
 $Options->DB='App\Models\Options' ;
 $Options->Value='option_value' ;
 $link_body = [] ;
 foreach ($Movies->all() as $key => $value) {
   $link = "https://api.themoviedb.org/3/movie/".$value->tmdb_id;
   $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang');
   $body = Http::get($linkpatch)->body() ;
   $link_body[] = json_decode($body);
 }

 return view('admincp.apidata.Movies.Movies_edit' , ['data' => $link_body, 'Movies'=> $Movies,]);


}
}
