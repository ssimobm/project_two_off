<?php


namespace App\Http\Controllers\Options;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Options;
use App\Movies;
//use App\Session;
use App\MyClass\MyFunction;
use Illuminate\Http\Response;
use App\Sessionget;
use Carbon\Carbon;
use Cookie;
use Session;
class views___ extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
$Options= Options::find(1) ;

//$test= Movies::find(3) ;
//$tiles= MyFunction::seo_title('App\Options','Seo_TvShows',$test->title);

$tiles= MyFunction::seo_title('App\Options','Setting_NameSite','');
$ip = request()->ip();
$userAgent = request()->userAgent();
$minutes = 3200;
    $response = new Response('Hello World');
    $minutes = 60;
    $blogKey = 'blog_1';
  //  echo "Session id is " . $request->session()->getId(). "<br><br>";
$simo = 1 ;
    //       $request->session()->start();
//     if (! isset(session::where('ip_address', $ip)->where('user_agent', $userAgent)->first()->ip_address)) {
//       $request->session()->put("testKey", "testValue");
//       $request->session()->save();
//        $data = $request->session()->all();
//       dd($simo+1);
//     }else {
//       $data = $request->session()->all();
//       $decode = base64_decode(session::where('ip_address', $ip)->where('user_agent', $userAgent)->first()->payload);
//       $decode= (unserialize($decode)) ;
// $user= $request->session()->has('testKey');
//       dd($request->session('kwtHAKdSnJlw9IgYqP6ggtHw0BU55EuZRWgHqnOj')->has('testKey'));
//     }



//  Session::put("testKey1", "testValue1");
//  Session::save();
//$simo = Sessionget::find('r8bjYcaoBPLoNPX21VQyPYUHANcjtFtrk7mlatMM');
//$decode= (unserialize(base64_decode($simo->payload))) ;
//$decode["postId"] = [$decode["_token"] , 5];

 // if (! isset(Sessionget::find($request->session()->getId())->id)) {
 //   $request->session()->put('data1', "testValue2020");
 //   $request->session()->save();
 // }


//dd($datee);
$ip = request()->ip();
$userAgent = request()->userAgent();
$movies = Movies::find("8") ;
$datas = Sessionget::where('id', $request->session()->getId())->where('ip_address', $ip)->first() ;
$DateGtm= Carbon::now("Africa/Casablanca")->isoFormat('M/D/YY, h:mm') ;
if (! $request->session()->get('TV_'.$movies->id)) {
       $movies->views = ($movies->views)+1;
       $movies->save();
       $request->session()->put('TV_'.$movies->id, ['TV_'.$movies->id => $DateGtm]);
       $request->session()->save();

         }


  // if (! isset($datas) and ! $request->session()->get('data1_'.$movies->id)) {
  //   $movies->views = ($movies->views)+1;
  //   $movies->save();
  //   $request->session()->getId() ;
  //   $request->session()->put('data1_'.$movies->id, $movies->id);
  //   $request->session()->save();
  // //  $Sessionget = Sessionget::find($request->session()->getId())->last_activity ;
  // //  $datee = Carbon::parse($Sessionget)->add(1, 'day')->timestamp ;
  // //  dd($datee);
  // }

echo "<br><h4>".$request->session()->get('TV_'.$movies->id)['TV_'.$movies->id]."</h4><br>";

echo "<br><h4>".($movies->views)."</h4><br>";
echo $request->session()->getId() ;
echo "<br>".$request->session()->get('data1') ;
//dd(session::find(session::getId()));


      //  return view("Options.Seo",["Options"=> $Options,"tiles"=> $tiles]) ;
    }
    public function update(Request $request)
    {
    //  $id = Options::where('option_name', 'Setting_NameSite')->first()->option_value ;
    //    $explode = str_replace("{simo}", $id, $request->seo_tvshows);
    //    dd($explode);

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
