<?php

namespace App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Controller;
use App\Models\Movies;
use App\Models\Tvshows;
use App\Models\Episodes;
use App\Models\Comments;
use App\Models\TVMeta;
use App\Models\Options;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class commentscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function findajax($id)
    {
      $DbMovies = Movies::where('id', $id)->firstOrFail();

      $comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10)->all();
dd($comments);
      $Tvshows = Movies::where('id', $id)->where('type', 'movies')->firstOrFail() ;

      $simo=$Tvshows->Seasons->sortBy('created_date');
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
    public function store(Request $request, $id)
    {
      $Db = new Comments ;

if (! isset($Db->find($request->co_id)->id)) {
    $Db1 = Movies::find($id) ;

  if (isset($Db1) and isset(Auth::user()->id)) {

    $Db->user_id = Auth::user()->id ;

    $Db->type = "movies" ;
    $Db->type_id = $Db1->id ;

    $Db->parent_id = "0" ;
    $Db->comments = $request->comment ;
    $Db->co_type = 'movies' ;
    $Db->timestamps ;

    $Db->save();
    $user =$Db->where('user_id',  $Db->user_id)->first()->user->name;
$likes = Comments::find($Db->id)->Like->where('type', 'Comments')->where('liks', '1')->all();
      return view('comments.comment',['data' => $Db,'user' => $user,'likes' => $likes ,]) ;
  }
}else {
  $Db1 = Movies::find($id) ;
if (isset($Db1) and isset(Auth::user()->id)) {

  $Db->user_id = Auth::user()->id ;
  $Db->type = "movies" ;
  $Db->type_id = $Db1->id ;

  $Db->parent_id = $request->co_id ;
  $Db->comments = $request->comment ;
  $Db->co_type = 'movies' ;
  $Db->timestamps ;

  $Db->save();
  $user =$Db->where('user_id',  $Db->user_id)->first()->user->name;
  $likes = Comments::find($Db->id)->Like->where('type', 'Comments')->where('liks', '1')->all();
        return view('comments.comment_reply',['data' => $Db,'user' => $user,'likes' => $likes ,]) ;
}

}
if (!isset(Auth::user()->id)) {
  return view('auth.ajaxlogin') ;
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
