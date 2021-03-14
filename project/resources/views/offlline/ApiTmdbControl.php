<?php

namespace App\Http\Controllers;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use App\Options;
class ApiTmdbControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $active = Options::where('option_name','=', 'tmdb_active')->first() ;
    if (isset($active->option_value) === true) {
      //$arrayOption = array('tmdb_active' => 'yessss','tmdb_api' => 'sssss', );
      //foreach ($arrayOption as $key => $va) {
      //  $arrayOption1 = array('option_name' => $key,'option_value' => $va, );
      //  $link = Options::where('option_name', $key)->update($arrayOption1);

  //}
}else {
$arrlange = serialize(array('ar-AR' => 'Arabic',
                  'en-US' => 'English',
                  'fr-FR' => 'France',

));
$arrayOption = array('tmdb_active' => 'yes',
                    'tmdb_api' => '',
                    'tmdb_lang' => 'Sa_ar',
                    'tmdb_langAll' => $arrlange,

                  );
foreach ($arrayOption as $key => $va) {
  Options::Insert([[
    'option_name' => $key ,
      'option_value' => $va ,
]]);
}

}
$Options = new MyClass2 ;
$Options->DB='App\Options' ;
$Options->Value='option_value' ;

return view('apitmdb.index',['data' => $Options]);




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
    public function update(Request $request)
    {


      //$arrayOption = array('tmdb_active' => 'yessss','tmdb_api' => 'sssss', );
      //foreach ($arrayOption as $key => $va) {
      //  $arrayOption1 = array('option_name' => $key,'option_value' => $va, );
      //  $link = Options::where('option_name', $key)->update($arrayOption1);

    //}

    foreach ($request->datago as $k1 => $v1) {

      $arrayOption = array('option_name' => "tmdb_".$k1,'option_value' => $v1, );

      $link = Options::where('option_name', "tmdb_".$k1)->update($arrayOption);


    }

return back();
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
