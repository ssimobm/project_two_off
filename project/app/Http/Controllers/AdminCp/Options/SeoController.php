<?php


namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Options;
use App\Models\Movies;
//use App\Models\Session;
use App\MyClass\MyFunction;
use Illuminate\Http\Response;
use App\Models\Sessionget;
use Carbon\Carbon;
use Cookie;
use Session;
class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth');
       $this->middleware('admin');
     }
    public function index(Request $request)
    {

MyFunction::authorizes(['AdmincpSuper','Admincp']);

$Options= Options::find(1) ;
$tiles= MyFunction::seo_title('App\Models\Options','Setting_NameSite','');
return view("admincp.Options.Seo",["Options"=> $Options,"tiles"=> $tiles]) ;

    }
    public function update(Request $request)
    {
MyFunction::authorizes(['AdmincpSuper','Admincp']);
$NameSite = Options::where('option_name', 'Seo_TvShows')->first();
if (isset($NameSite)) {
  $NameSite->option_value = $request->seo_tvshows ;
  $NameSite->save();
}else{
  $NameSite = new Options;
  $NameSite->option_name = 'Seo_TvShows' ;
  $NameSite->option_value = $request->seo_tvshows ;
  $NameSite->save();
}

$DescSite = Options::where('option_name', 'Seo_Movies')->first();
if (isset($DescSite)) {
  $DescSite->option_value = $request->seo_movies ;
  $DescSite->save();
}else{
  $DescSite = new Options;
  $DescSite->option_name = 'Seo_Movies' ;
  $DescSite->option_value = $request->seo_movies ;
  $DescSite->save();
}

$Seasons = Options::where('option_name', 'Seo_Seasons')->first();
if (isset($Seasons)) {
  $Seasons->option_value = $request->seo_seasons ;
  $Seasons->save();
}else{
  $Seasons = new Options;
  $Seasons->option_name = 'Seo_Seasons' ;
  $Seasons->option_value = $request->seo_seasons ;
  $Seasons->save();
}

$Episodese = Options::where('option_name', 'Seo_Episodes')->first();
if (isset($Episodese)) {
  $Episodese->option_value = $request->seo_episodes ;
  $Episodese->save();
}else{
  $Episodese = new Options;
  $Episodese->option_name = 'Seo_Episodes' ;
  $Episodese->option_value = $request->seo_episodes ;
  $Episodese->save();
}

return back();


    }
}
