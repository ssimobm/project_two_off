<?php


namespace App\Http\Controllers\AdminCp\Admin\Api;
use App\Http\Controllers\Controller;
use App\MyClass\MyFunction;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorys;
use App\Models\CategorysMeta;
use App\Models\New_Movies;
use App\Models\TVMeta;
use App\Models\Options;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;



class ApiMovieController extends Controller
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





     public function indexajax($id)
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

       $Movies = New_Movies::get() ;
       if (isset($Movies)) {
         // code...

      $Options = new MyClass2 ;
      $Options->DB='App\Models\Options' ;
      $Options->Value='option_value' ;


       if ($Options->Simo_Op('option_name','tmdb_api') == true) {
         $link = "https://api.themoviedb.org/3/movie/popular";
         $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;

      $daata1 = json_decode(file_get_contents($linkpatch))->results ;
       return view('admincp.apidata.Movies.m_ajax' , ['data' => $daata1, 'Movies'=> $Movies,]);
     }
     }




         }

     public function index()
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

 $Movies = New_Movies::get() ;
 if (isset($Movies)) {
   // code...
$id='1';
$Options = new MyClass2 ;
$Options->DB='App\Models\Options' ;
$Options->Value='option_value' ;


 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
   $link = "https://api.themoviedb.org/3/movie/popular";
   $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;

$daata1 = json_decode(file_get_contents($linkpatch))->results ;
 return view('admincp.apidata.Movies.m_index' , ['data' => $daata1, 'Movies'=> $Movies,]);
 }
 }

     }

}
