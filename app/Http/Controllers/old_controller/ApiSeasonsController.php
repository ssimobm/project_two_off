<?php

namespace App\Http\Controllers\AdminCp\Admin\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\New_Tvshows;
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


class ApiSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


     public function home()
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

       $simoo=Seasons::simplePaginate(12);

         return view('admincp.apidata.Episodes.s_index',["data" => $simoo]);
     }


     public function indexajax($id)
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Movies = New_Tvshows::get() ;
 if (isset($Movies)) {
   // code...

       $Options = new MyClass2 ;
       $Options->DB='App\Models\Options' ;
       $Options->Value='option_value' ;

 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
 $daata1 = json_decode($Options->go($id,$Options->Simo_Op('option_name','tmdb_api'),$Options->Simo_Op('option_name','tmdb_lang')), true)["results"];
 return view('admincp.apidata.Movies.m_ajax' , ['data' => $daata1, 'Movies'=> $Movies,'id' => $id,]);
 }
 }




     }

     public function index($tv , $season)
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Episodes = Episodes::get() ;
$Seasons = Seasons::findOrFail($season) ;
$very = $Seasons->episode->first() ;

 if (isset($Seasons)) {
   // code...
$id='1';
$Options = new MyClass2 ;
$Options->DB='App\Models\Options' ;
$Options->Value='option_value' ;


 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
   $link = "https://api.themoviedb.org/3/tv/";

   $linkpatch = $link.''.$Seasons->tmdb_id.'/season/'.$Seasons->season_nm."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

$daata1 = json_decode(file_get_contents($linkpatch))->episodes ;

 return view('admincp.apidata.Episodes.s_index1' , ['data' => $daata1, 'Episodes'=> $Episodes, 'Seasons' => $Seasons ,]);
 }

 }
 return redirect('data/Episodes/')->with('status', 'Profile updated!');
     }

}
