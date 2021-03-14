<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Movies;
use App\Seasons;
use App\Episodes;
use App\TVMeta;
use App\Options;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ApiSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function home()
     {
       $simoo=Seasons::simplePaginate(12);

         return view('apidata.Episodes.s_index',["data" => $simoo]);
     }


     public function indexajax($id)
     {
 $Movies = Movies::get() ;
 if (isset($Movies)) {
   // code...

       $Options = new MyClass2 ;
       $Options->DB='App\Options' ;
       $Options->Value='option_value' ;

 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
 $daata1 = json_decode($Options->go($id,$Options->Simo_Op('option_name','tmdb_api'),$Options->Simo_Op('option_name','tmdb_lang')), true)["results"];
 return view('apidata.Movies.m_ajax' , ['data' => $daata1, 'Movies'=> $Movies,'id' => $id,]);
 }
 }




     }

     public function index($tv , $season)
     {
 $Episodes = Episodes::get() ;
$Seasons = Seasons::findOrFail($season) ;
$very = $Seasons->episode->first() ;

 if (isset($Seasons)) {
   // code...
$id='1';
$Options = new MyClass2 ;
$Options->DB='App\Options' ;
$Options->Value='option_value' ;


 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
   $link = "https://api.themoviedb.org/3/tv/";
   $linkpatch = $link.''.$Seasons->Tv_Tmdb.'/season/'.$Seasons->Sea_Nm."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

$daata1 = json_decode(file_get_contents($linkpatch))->episodes ;

 return view('apidata.Episodes.s_index1' , ['data' => $daata1, 'Episodes'=> $Episodes, 'Seasons' => $Seasons ,]);
 }

 }


 return redirect('data/Episodes/')->with('status', 'Profile updated!');


     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request , $tv , $season)
     {
       // start if AutoData
       $DbTVshows = new Episodes;
       if (! isset($DbTVshows::where('Sea_id', $season)->where('Ep_Nm', $request->ids)->first()->Ep_Nm)) {
        $season_get = Seasons::find($season);
         $Options = new MyClass2 ;
         $Options->DB='App\Options' ;
         $Options->Value='option_value' ;
         $link = "https://api.themoviedb.org/3/tv/";
         $linkpatch = $link.$season_get->Tv_Tmdb.'/season/'.$season_get->Sea_Nm.'/episode/'.$request->ids."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

         $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));

         if (isset($get->status_code)) {
          return back();
         }
         $gourl = $link.$season_get->Tv_Tmdb.'/season/'.$season_get->Sea_Nm.'/episode/'.$request->ids."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";



      $dates = Carbon::now() ;
      $namedir='/'.$dates->year.'/'.$dates->month;
 $Poster_Path= ''.$get->still_path ;

     $DbTVshows = new Episodes;
     $DbTVshows->tv_id = $tv;
     $DbTVshows->sea_id = $season;
     $DbTVshows->user_id = Auth::user()->id;
     $DbTVshows->Name = $season_get->Name_tv.' '.$season_get->Name_sea.' '.$get->name.'';
     $DbTVshows->slug = Str::slug($season_get->Name_tv.' '.$season_get->Name_sea.' '.$get->name.'' , "-");
     $DbTVshows->Overview = $get->overview;
     $DbTVshows->Name_ep = $get->name;
     $DbTVshows->Name_sea = $season_get->Name_sea;
     $DbTVshows->Name_tv = $season_get->Name_tv ;
     $DbTVshows->Ep_Nm = $get->episode_number ;
     $DbTVshows->Sea_Nm = $season_get->Sea_Nm ;
     $DbTVshows->Tv_Tmdb = $season_get->Tv_Tmdb;
     $DbTVshows->First_Date = $get->air_date;
     if (isset($Poster_Path)) {

 $images= "https://image.tmdb.org/t/p/w780/".$Poster_Path;
 $contents= file_get_contents($images ,false, stream_context_create(['http' => ['ignore_errors' => true]]));


 if ($images != "https://image.tmdb.org/t/p/w780/") {

 //$name = substr($images, strrpos($images, '/') + 1);
 Storage::put('public/images/'.$namedir."/".$Poster_Path, $contents);
 $DbTVshows->Postimg = $namedir.''.$Poster_Path ;

 }else {
   $DbTVshows->Postimg = "" ;

 }


     }


     $DbTVshows->timestamps;
     $DbTVshows->save();


       // end if AutoData
 return $DbTVshows->Ep_Nm;}
    }
    public function store1(Request $request , $tv , $season , $ep)
    {
      // start if AutoData
      $DbTVshows = new Episodes;
      if (! isset($DbTVshows::where('Sea_id', $season)->where('Ep_Nm', $ep)->first()->Ep_Nm)) {

       $season_get = Seasons::find($season);
        $Options = new MyClass2 ;
        $Options->DB='App\Options' ;
        $Options->Value='option_value' ;
        $link = "https://api.themoviedb.org/3/tv/";
        $linkpatch = $link.$season_get->Tv_Tmdb.'/season/'.$season_get->Sea_Nm.'/episode/'.$ep."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

        $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));

        if (isset($get->status_code)) {
         return back();
        }
        $gourl = $link.$season_get->Tv_Tmdb.'/season/'.$season_get->Sea_Nm.'/episode/'.$ep."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";



     $dates = Carbon::now() ;
     $namedir='/'.$dates->year.'/'.$dates->month;
$Poster_Path= ''.$get->still_path ;

    $DbTVshows = new Episodes;
    $DbTVshows->tv_id = $tv;
    $DbTVshows->sea_id = $season;
    $DbTVshows->user_id = "1";
    $DbTVshows->Name = $season_get->Name_tv.' '.$season_get->Name_sea.' '.$get->name.'';
    $DbTVshows->slug = Str::slug($season_get->Name_tv.' '.$season_get->Name_sea.' '.$get->name.'' , "-");

    $DbTVshows->Overview = $get->overview;
    $DbTVshows->Name_ep = $get->name;
    $DbTVshows->Name_sea = $season_get->Name_sea;
    $DbTVshows->Name_tv = $season_get->Name_tv ;
    $DbTVshows->Ep_Nm = $get->episode_number ;
    $DbTVshows->Sea_Nm = $season_get->Sea_Nm ;
    $DbTVshows->Tv_Tmdb = $season_get->Tv_Tmdb;
    $DbTVshows->First_Date = $get->air_date;
    if (isset($Poster_Path)) {

$images= "https://image.tmdb.org/t/p/w780/".$Poster_Path;
$contents= file_get_contents($images ,false, stream_context_create(['http' => ['ignore_errors' => true]]));


if ($images != "https://image.tmdb.org/t/p/w780/") {

//$name = substr($images, strrpos($images, '/') + 1);
Storage::put('public/images/'.$namedir."/".$Poster_Path, $contents);
$DbTVshows->Postimg = $namedir.''.$Poster_Path ;

}else {
  $DbTVshows->Postimg = "" ;

}


    }


    $DbTVshows->timestamps;
    $DbTVshows->save();


      // end if AutoData
return $DbTVshows->Ep_Nm;

}
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
