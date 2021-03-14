<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\New_Tvshows;
use App\Models\TVMeta;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TvShowsController2020 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//  $user = New_Tvshows::whereDate('created_at', Carbon::now()->subHour())->paginate(20);
$user = New_Tvshows::paginate(24);


//dd($user->nextPageUrl());
if (isset($user)) {


$user1 = TVMeta::get() ;
  return view('tvshows.home',['data' => $user]);
}




    }
    public function loadajax(Request $request)
    {

      $user = New_Tvshows::paginate(5);

      return view('tvshows.ajaxload',['data' => $user]);



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adcreate()
    {
return view('tvshows.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = New_Tvshows::create([
    'title' =>  $request->title,
    'type' => $request->type,
    'content' => $request->content,
]);
    $user->tvdata()->Insert([[
        'simokey' => 'name',
         'simovalue' => '',
         'tv_id' => $user->id,

   ],[
       'simokey' => 'last',
        'simovalue' => '',
         'tv_id' => $user->id,
  ],[
      'simokey' => 'profile',
       'simovalue' => '',
       'tv_id' => $user->id,

 ]]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tvshows  $tvshows
     * @return \Illuminate\Http\Response
     */
    public function show(Tvshows $tvshows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tvshows  $tvshows
     * @return \Illuminate\Http\Response
     */
    public function edit(Tvshows $tvshows, $id)
    {


$data = New_Tvshows::whereIn('id', [$id])->firstOrFail();
$datameta = $data->tvdata;

        return view('tvshows.edit',['data' => $data,'datameta' => $datameta,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tvshows  $tvshows
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $this->validate($request, [
      //"simovalue"    => "required|array|min:3",
        'simovalue.*' => 'required|string|distinct|min:3',

    ]);

    $user1 = New_Tvshows::find($id);


    $user3 = $user1->tvdata;
    foreach ($user3 as $key => $value) {
$siimo = $value->id ;
$siimoo = $value->simokey ;
if ($value->simokey == 'last') {
// code...TVMeta
$user0 = $user1->tvdata()->where('id', $value->id)->update([
  'simokey' =>  'last',
  'simovalue' => $request->simovalue['last'],
]);
}
if ($value->simokey == 'name') {
// code...
$user2 = $user1->tvdata()->where('id', $value->id)->update([
'simokey' =>  'name',
'simovalue' => $request->simovalue['name'],

]);
}
if ($value->simokey == 'profile') {
// code...
$user2 = $user1->tvdata()->where('id', $value->id)->update([
'simokey' =>  'profile',
'simovalue' => serialize($request->simovalue),

]);
}
  }
    if ($value->simokey == 'profile'){}
      else {
      $user2 = $user1->tvdata()->create([
      'simokey' =>  'profile',
      'simovalue' => serialize($request->simovalue),
      'tv_id' => $id,
      ]);
    }

$user = $user1->update([
    'title' => $request->simovalue['title'],
    'type' => $request->simovalue['type'],
    'content' => $request->simovalue['content'],
]);
return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tvshows  $tvshows
     * @return \Illuminate\Http\Response
     */
    public function delet(Tvshows $tvshows, $id)
    {
      $user1 = New_Tvshows::Where('id' ,$id)->firstOrFail();


      $user3 = $user1->tvdata()->delete();
      $user1->delete();

    }

    public function restore(Tvshows $tvshows, $id)
    {
      $user1 = New_Tvshows::onlyTrashed()->Where('id' ,$id)->firstOrFail();


      $user3 = $user1->tvdata()->restore();
      $user1->restore();
    }

    public function deleted(Tvshows $tvshows, $id)
    {
      $user1 = New_Tvshows::onlyTrashed()->Where('id' ,$id)->firstOrFail();

$user1->forceDelete();
      $user1->tvdata()->forceDelete();

    }
}
