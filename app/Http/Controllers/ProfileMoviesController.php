<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Movies;
use App\Models\TVMeta;
use App\Models\New_Movies;
use App\Models\New_Movies_Meta;
use App\Models\Options;

use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;


class ProfileMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $Movies = New_Movies::where('slug', $id)->firstOrFail() ;
      $user = $Movies->usersD ;
      $vistor = (new \App\MyClass\SimoPhp)->GetVisitor(Request(),$Movies,'movies',$Movies->id) ;

      $Moviesdata = $Movies->tvdata ;
      $SeoAll = new \App\MyClass\SimoPhp("Seo_Movies",$Movies->title) ;
      $Seo = $SeoAll->seo_meta() ;
      $arrayName = array('Tv' =>$Movies ,'tvdata' =>$Moviesdata ,'user' => $user,'Seo' => $Seo);
      return  View('sites.Movies.Profile',$arrayName);
    }
    public function watch($Movies)
    {
      $DbMovies = New_Movies::where('slug', $Movies)->firstOrFail();
      $SeoAll = new \App\MyClass\SimoPhp("Seo_Movies",$DbMovies->title) ;
      $Seo = $SeoAll->seo_meta() ;
      //$comments = $DbMovies->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);
      $Data = $DbMovies->tvdata;
      return View('sites.Movies.watch',["movies" => $DbMovies,"Data" => $Data,"Seo" => $Seo, ]);
    }

}
