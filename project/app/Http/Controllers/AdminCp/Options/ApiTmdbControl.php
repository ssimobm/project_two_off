<?php

namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use App\Models\Options;
use App\MyClass\MyFunction;

class ApiTmdbControl extends Controller
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


    public function index()
    {

      MyFunction::authorizes(['AdmincpSuper','Admincp']);

    $active = Options::where('option_name','=', 'tmdb_active')->first() ;
    if (isset($active->option_value) === false){
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
$Options->DB='App\Models\Options' ;
$Options->Value='option_value' ;

return view('admincp.apitmdb.index',['data' => $Options]);




    }


    public function update(Request $request)
    {

    MyFunction::authorizes(['AdmincpSuper','Admincp']);

    foreach ($request->datago as $k1 => $v1) {

      $arrayOption = array('option_name' => "tmdb_".$k1,'option_value' => $v1, );

      $link = Options::where('option_name', "tmdb_".$k1)->update($arrayOption);


    }

return back();
    }
}
