<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\TvShows;
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


class ApiSeasonssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function home()
     {
       $simoo=TvShows::where('type', 'Tvshows')->simplePaginate(12);

         return view('apidata.Seasonss.s_index',["data" => $simoo]);
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

     public function index($tv)
     {
       $TvShows = TvShows::findOrFail($tv) ;
       $Seasons = Seasons::get() ;
//$very = $TvShows->season ;
 if (isset($TvShows)) {

$id='1';
$Options = new MyClass2 ;
$Options->DB='App\Options' ;
$Options->Value='option_value' ;


 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
   $link = "https://api.themoviedb.org/3/tv/";
   $linkpatch = $link.''.$TvShows->tmdb_id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

$daata1 = json_decode(file_get_contents($linkpatch)) ;

 return view('apidata.Seasonss.s_index1' , ['data' => $daata1, 'Seasons'=> $Seasons, 'TvShows' => $TvShows ,]);
 }

 }
return redirect('data/seasonss/')->with('status', 'Profile updated!');
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
     public function store(Request $request , $tv)
     {
       // start if AutoData
       $DbTVshows = new Seasons;
       $TVshows =Tvshows::find($tv);
       if (! isset($DbTVshows::where('tv_id', $tv)->where('Sea_Nm', $request->ids)->first()->Sea_Nm)) {

         // start if AutoData
           $Options = new MyClass2 ;
           $Options->DB='App\Options' ;
           $Options->Value='option_value' ;
           $link = "https://api.themoviedb.org/3/tv/";
           $linkpatch = $link.$TVshows->tmdb_id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

           $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));

           if (isset($get->status_code)) {
            return back();
           }
         //  $gourl = $link.$request->id_data."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
         //  $images= json_decode(file_get_contents($gourl))->backdrops;


           if (isset($get)) {
             foreach ($get->seasons as $key => $value) {
             if ($value->season_number == $request->ids) {
             $getsea =$value;
               }
            }

           if (isset($getsea)) {
                     $dates = Carbon::now() ;
                      $namedir='/'.$dates->year.'/'.$dates->month;
                      $NameFull= $get->name." ".$getsea->name;
                      $Date_Seo= $getsea->air_date;


                     $Episode_Count= $getsea->episode_count;
                     $Overview= $getsea->overview;
                     $Poster_Path= $getsea->poster_path;
                     $Season_Number= $getsea->season_number;

                     $DbTVshows = new Seasons;
                     $DbTVshows->tv_id = $TVshows->id;
                     $DbTVshows->user_id = Auth::user()->id;
                     $DbTVshows->Name = $NameFull;
                    $DbTVshows->slug = Str::slug($NameFull , "-");
                     $DbTVshows->Overview = $Overview;
                     $DbTVshows->Name_sea = $getsea->name;
                     $DbTVshows->Name_tv = $get->name ;
                     $DbTVshows->Ep_Count = $Episode_Count ;
                     $DbTVshows->Tv_Tmdb = $get->id;
                     $DbTVshows->First_Date = $Date_Seo;
                     $DbTVshows->Sea_Nm = $Season_Number ;

                     if (isset($Poster_Path)) {
               $images= "https://image.tmdb.org/t/p/w780/".$Poster_Path;
               $contents = file_get_contents($images);
               //$name = substr($images, strrpos($images, '/') + 1);
               Storage::put('public/images/'.$namedir."/".$Poster_Path, $contents);
                     $DbTVshows->Postimg = $namedir.'/'.$Poster_Path ;
                     }
                     $DbTVshows->timestamps;
                     $DbTVshows->save();
                     }

                   }



         // end if AutoData
 return $DbTVshows->Sea_Nm;
    }}
    public function store1(Request $request , $tv , $season)
    {
      // start if AutoData
      $DbTVshows = new Seasons;
      $TVshows =Tvshows::find($tv);
      if (! isset($DbTVshows::where('tv_id', $tv)->where('Sea_Nm', $season)->first()->Sea_Nm)) {

        // start if AutoData
          $Options = new MyClass2 ;
          $Options->DB='App\Options' ;
          $Options->Value='option_value' ;
          $link = "https://api.themoviedb.org/3/tv/";
          $linkpatch = $link.$TVshows->tmdb_id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

          $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));

          if (isset($get->status_code)) {
           return back();
          }
        //  $gourl = $link.$request->id_data."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
        //  $images= json_decode(file_get_contents($gourl))->backdrops;


          if (isset($get)) {
            foreach ($get->seasons as $key => $value) {
            if ($value->season_number == $season) {
            $getsea =$value;
              }
           }

          if (isset($getsea)) {
                    $dates = Carbon::now() ;
                     $namedir='/'.$dates->year.'/'.$dates->month;
                     $NameFull= $get->name." ".$getsea->name;
                     $Date_Seo= $getsea->air_date;
                    $Episode_Count= $getsea->episode_count;
                    $Overview= $getsea->overview;
                    $Poster_Path= $getsea->poster_path;
                    $Season_Number= $getsea->season_number;

                    $DbTVshows = new Seasons;
                    $DbTVshows->tv_id = $TVshows->id;
                    $DbTVshows->user_id = Auth::user()->id;
                    $DbTVshows->Name = $NameFull;
                    $DbTVshows->slug = Str::slug($NameFull , "-");

                    $DbTVshows->Overview = $Overview;
                    $DbTVshows->Name_sea = $getsea->name;
                    $DbTVshows->Name_tv = $get->name ;
                    $DbTVshows->Ep_Count = $Episode_Count ;
                    $DbTVshows->Tv_Tmdb = $get->id;
                    $DbTVshows->First_Date = $Date_Seo;
                    $DbTVshows->Sea_Nm = $Season_Number ;

                    if (isset($Poster_Path)) {
              $images= "https://image.tmdb.org/t/p/w780/".$Poster_Path;
              $contents = file_get_contents($images);
              //$name = substr($images, strrpos($images, '/') + 1);
              Storage::put('public/images/'.$namedir."/".$Poster_Path, $contents);
                    $DbTVshows->Postimg = $namedir.'/'.$Poster_Path ;
                    }
                    $DbTVshows->timestamps;
                    $DbTVshows->save();
                  }

                }



      // end if AutoData
return $DbTVshows->Sea_Nm;
 }}

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
