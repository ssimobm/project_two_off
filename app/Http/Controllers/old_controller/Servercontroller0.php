<?php

namespace App\Models\Http\Controllers;
use App\Models\Movies;
use Auth;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\Options;
use Illuminate\Http\Request;

class Servercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function tv_ep_index($tv, $Sea, $Ep)
     {
       $DbMovies = Tvshows::where('type', 'Tvshows')->where('slug', $tv)->firstOrFail();
       $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);

       if (isset(Auth::user()->id)) {
         $user_simo = Auth::user()->id ;
       }else {
         $user_simo = null ;
       }
       $Data = $DbMovies->tvdata;
       $Seasons = $DbMovies->Seasons->where('Sea_Nm', $Sea)->first() ;
       $Episodes = $Seasons->episode->where('Ep_Nm', $Ep)->first();

 return view('Episodes.home',["Episode" => $DbMovies,"Data" => $Data,"comments" => $comments, "user_simo" => $user_simo ,"Seasons" => $Seasons ,"Episodes" => $Episodes ,]);
       }

     public function ep_index($id)
     {
       $DbMovies = Movies::where('type', 'Tvshows')->where('slug', $id)->firstOrFail();
       $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);
       if (isset(Auth::user()->id)) {
         $user_simo = Auth::user()->id ;
       }else {
         $user_simo = null ;
       }

       $Data = $DbMovies->tvdata;

       //$test = $Data->where('simokey', 'Movie_Title')->first();
 //dd($test);
       return view('Episodes.profile',["movies" => $DbMovies,"Data" => $Data,"comments" => $comments, "user_simo" => $user_simo ,]);
     }




     public function movies_ajaxtest(Request $request , $Movies)
     {
       $DbMovies = Movies::where('type', 'Movies')->where('id', $Movies)->firstOrFail();

       $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);   //  foreach ($comments as $key => $value) {
  //         echo $value.'<br>';
  //       }
//   dd($comments);
if (isset(Auth::user()->id)) {
  $user_simo = Auth::user()->id ;
}else {
  $user_simo = null ;
}
       $Data = $DbMovies->tvdata;

       //$test = $Data->where('simokey', 'Movie_Title')->first();
 //dd($test);
       return view('comments.Comment_ajaxtest',["movies" => $DbMovies,"Data" => $Data,"comments" => $comments,"user_simo" => $user_simo ,]);
     }


     public function movies_ajax(Request $request , $Movies)
     {
       $DbMovies = Movies::where('type', 'Movies')->where('id', $Movies)->firstOrFail();
//sortByDesc('created_at')
       $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);
    //  foreach ($comments as $key => $value) {
  //         echo $value.'<br>';
  //       }
//   dd($comments);
       $Data = $DbMovies->tvdata;
       //$test = $Data->where('simokey', 'Movie_Title')->first();
 //dd($test);

       return view('Comments.Comment_ajax',["movies" => $DbMovies,"Data" => $Data,"comments" => $comments,]);
     }
     public function index($Movies)
     {
       $DbMovies = Movies::where('type', 'Movies')->where('id', $Movies)->firstOrFail();

       $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);
       if (isset(Auth::user()->id)) {
         $user_simo = Auth::user()->id ;
       }else {
         $user_simo = null ;
       }

       $Data = $DbMovies->tvdata;
       //$test = $Data->where('simokey', 'Movie_Title')->first();
 //dd($test);
       return view('Server.ajax_se_movies',["movies" => $DbMovies,"Data" => $Data,"comments" => $comments, "user_simo" => $user_simo ,]);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
