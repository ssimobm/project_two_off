<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Categorys;
use App\CategorysMeta;
use App\Movies;
use App\TVMeta;
use App\Options;
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
     public function indexajax($id)
     {
       $Movies = Movies::get() ;
       if (isset($Movies)) {
         // code...

      $Options = new MyClass2 ;
      $Options->DB='App\Options' ;
      $Options->Value='option_value' ;


       if ($Options->Simo_Op('option_name','tmdb_api') == true) {
         $link = "https://api.themoviedb.org/3/movie/popular";
         $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;

      $daata1 = json_decode(file_get_contents($linkpatch))->results ;
       return view('apidata.Movies.m_ajax' , ['data' => $daata1, 'Movies'=> $Movies,]);
     }
     }




         }

     public function index()
     {
 $Movies = Movies::get() ;
 if (isset($Movies)) {
   // code...
$id='1';
$Options = new MyClass2 ;
$Options->DB='App\Options' ;
$Options->Value='option_value' ;


 if ($Options->Simo_Op('option_name','tmdb_api') == true) {
   $link = "https://api.themoviedb.org/3/movie/popular";
   $linkpatch = $link."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."&page=".$id;

$daata1 = json_decode(file_get_contents($linkpatch))->results ;
 return view('apidata.Movies.m_index' , ['data' => $daata1, 'Movies'=> $Movies,]);
 }
 }




     }

    public function index2(Request $request ,$ids)
    {

  //    $url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
  //     $contents = file_get_contents($url);
  //     $name = substr($url, strrpos($url, '/') + 1);
  //     Storage::put($name, $contents);
  //     dd(Storage::put('images'.$name, $contents));
    $DbMovies= new Movies;
    $Db= $DbMovies->where('tmdb_id', $ids)->first();

// chek exist Movies TMDb
if (isset($Db->tmdb_id) === False) {




    $Options = new MyClass2 ;
    $Options->DB='App\Options' ;
    $Options->Value='option_value' ;
    $link = "https://api.themoviedb.org/3/tv/";
    $linkpatch = $link.$ids."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
    $get= json_decode(file_get_contents($linkpatch));
    $gourl = $link.$ids."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
    $images= json_decode(file_get_contents($gourl))->backdrops;
    $dates = Carbon::now() ;
    $namedir='/'.$dates->year.'/'.$dates->month;
    //very link lang null to ar and en
    if (count($images) === 0) {
    $gourl = $link.$ids."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=en,ar";
    $images= json_decode(file_get_contents($gourl))->backdrops;
    }
    //end very link lang null to ar and en
      for ($i=0; $i < count($images) ; $i++) {
      if ($i < 9) {
    // switch lang...
          switch ($images[$i]->iso_639_1) {
          case null:
          $url = "https://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
          $data[]= $namedir.$images[$i]->file_path ;
            break;
          case "en":
          $url = "https://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
          $data[]= $namedir.$images[$i]->file_path ;
            break;
          case "ar":
          $url = "https://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
          $data[]= $namedir.$images[$i]->file_path ;


        } //end switch lang...

 // if chek file


//if (! isset($Db->tvdata)) {
//  $Dbun= $Db->tvdata->where('simokey', 'tvshow_Gallery')->first()->simovalue;
//  $Dbunserial= unserialize($Dbun);
//$chek= Storage::exists('public/Backgrounds'.$Dbunserial[$i]);
//if (! isset($chek)) {

    $contents = file_get_contents($url);
    $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/Backgrounds/'.$namedir.'/'.$images[$i]->file_path, $contents, 'public');

//  }

 //}




 //$file_chek = '2020/5/hy7CPzl227MOlByLUcD9nWuwbjn.jpg';
//$file_chek = "/".substr($file_chek, strrpos($file_chek, '/') + 1) ;
//if ($file_chek !== $images[$i]->file_path) {}
 //end  if chek file
}
}
//end for
//name database
$Gallery = serialize($data) ;
$NmSe = $get->number_of_seasons ;
$NmEp = $get->number_of_episodes ;
$LastEpdate = $get->last_air_date ;
$LastEp = $get->last_episode_to_air->episode_number ;
$first_date = $get->first_air_date ;
$NextEp = $get->next_episode_to_air ;
if (isset($get->next_episode_to_air->air_date)) {
  $NextEp = $get->next_episode_to_air->air_date ;
}else {
  $NextEp = $get->next_episode_to_air ;
}
$Country = $get->popularity ;
$Lang = $get->languages[0] ;
$network = $get->networks[0]->name ;
$Popular = $get->popularity ;
$Rating = $get->vote_average ;
$TimeEp = $get->episode_run_time[0] ;
//end name database


//$Dbun= $Db->tvdata->where('simokey', 'tvshow_Postimg')->first()->simovalue;

//$chek1= Storage::exists('public/images'.$Dbun);
//if (! $chek1) {

  //$url1 = "https://image.tmdb.org/t/p/w780".$get->poster_path;
  //$contents1 = file_get_contents($url1);
  //$name = substr($url, strrpos($url, '/') + 1);
  //        Storage::put('public/images/'.$namedir.''.$get->poster_path, //$contents1, 'public');

//  }

//$chek1= Storage::exists('public/images/'.$namedir.''.$get->poster_path)."";
//if (! $chek1) {
  $url1 = "https://image.tmdb.org/t/p/w780".$get->poster_path;
  $contents1 = file_get_contents($url1);
  $name = substr($url, strrpos($url, '/') + 1);
          Storage::put('public/images/'.$namedir.''.$get->poster_path, $contents1, 'public');
//
//array database
$arrayget = array( 'Title' => $get->name ,
                   'Postimg' => $namedir.''.$get->poster_path,
                   'Background' => $get->backdrop_path,
                   'Gallery' => $Gallery,
                   'Status' => $get->status,
                   'Tempmdb' => $get->id,
                   'NmSe' => $NmSe,
                   'NmEp' => $NmEp,
                   'First_Date' => $first_date,
                   'LastEpdate' => $LastEpdate,
                   'LastEp' => $LastEp,
                   'NextEp' => "".$NextEp,
                   'Country' => $Country,
                   'Lang' => $Lang,
                   'Network' => $network,
                   'Popular' => $Popular,
                   'Rating' => $Rating,
                   'TimeEp' => $TimeEp,

                      );
//end array database
//save Movies database

$DbMovies->title = $get->name;
$DbMovies->type = 'Movies';
$DbMovies->slug = Str::slug($get->name , "-");
$DbMovies->user_id = Auth::user()->id;

$DbMovies->content = $get->overview ;
$DbMovies->tmdb_id = $get->id ;
$DbMovies->timestamps;
$DbMovies->save();
foreach ($arrayget as $k1 => $v1) {

//$arrayOption = array('simokey' => "tvshow_".$k1,'simovalue' => $v1,'tv_id' => $user->id, );
//$link = $user->tvdata()->Insert($arrayOption);
  $Admin = new TVMeta;
  $Admin->simokey = "tvshow_".$k1 ;
  $Admin->simovalue =  $v1 ;
  $Admin->tv_id =  $DbMovies->id ;
  $DbMovies->tvdata()->save($Admin);
 }
//end save Movies database
}
// end chek exist Movies TMDb

//$simo = serialize($data) ;
//echo $simo;
    //  echo $get->episode_run_time."<br>";
    //   echo $get->air_date."<br>";
   // echo $get->last_air_date."<br>";

    //  $user = new Movies;
    //  $user->title = $get->name;
    //   $user->type = 'Movies';
    //   $user->content = $get->overview ;
    //   $user->tmdb_id = $get->id ;
    //   $user->timestamps;
    //   $user->save();

    //$user = Movies::create([
    //'title' =>  $get->name,
    //'type' => 'Movies',
    //'content' => $get->overview,
    //]);


    //$arrayget = array('title' => $get->name ,
    //                 'postimg' => $get->poster_path,
    //                  'background' => $get->backdrop_path,
    //                 'status' => $get->status,
    //                'tmdb' => $get->id,


    //              );



    //foreach ($arrayget as $k1 => $v1) {

    //$arrayOption = array('simokey' => "tvshow_".$k1,'simovalue' => $v1,'tv_id' => $user->id, );
    //$link = $user->tvdata()->Insert($arrayOption);


    ////$Admin = new TVMeta;
    //  $Admin->simokey = "tvshow_".$k1 ;
    //  $Admin->simovalue =  $v1 ;

    //  $user->tvdata()->save($Admin);


    //}

    //if($request->$ajax())
    //        {
    //          return "True request!";
    //        }



    // if (isset($get->next_episode_to_air) === true) {
     //}


    // return response('error');
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
     public function store(Request $request ,$id)
     {

               $DbMovies= new Movies;

                    $Options = new MyClass2 ;
                    $Options->DB='App\Options' ;
                    $Options->Value='option_value' ;
                    $link = "http://api.themoviedb.org/3/movie/";
                    $linkpatch = $link.$request->ids."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

                    $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));


                    $gourl = $link.$request->ids."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
                    $dates = Carbon::now() ;
                    $namedir='/'.$dates->year.'/'.$dates->month;

                    if (isset($get->status_code)) {
                     return back();
                   }else {
                     $images= json_decode(file_get_contents($gourl))->backdrops;

                     //very link lang null to ar and en
                     if (count($images) === 0) {
                     $gourl = $link.$request->ids."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=en,ar";

                     $images= json_decode(file_get_contents($gourl))->backdrops;
                     }
                     $Gallery = "" ;
                     if (count($images) === 1) {

                     //end very link lang null to ar and en
                       for ($i=0; $i < count($images) ; $i++) {
                         if ($i < 9) {
                             // switch lang...
                                   switch ($images[$i]->iso_639_1) {
                                   case null:
                                   $url[] = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                                   $data[]= $namedir.$images[$i]->file_path ;
                                     break;
                                   case "en":
                                   $url[] = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                                   $data[]= $namedir.$images[$i]->file_path ;
                                     break;
                                   case "ar":
                                   $url[] = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                                   $data[]= $namedir.$images[$i]->file_path ;


                                 } //end switch lang...




                   }
                 }
                 //end for

                 foreach ($url as $key => $value) {
                   $name = substr($value, strrpos($value, '/') + 1);
                   $chek= Storage::exists('public/Backgrounds'.$namedir.'/'.$name);
                   if (! $chek) {

                   $contents = file_get_contents($value);
                   Storage::put('public/Backgrounds/'.$namedir.'/'.$name, $contents, 'public');
              }
                 }
                 //name database
                 if (isset($data)) {
                    $Gallery = serialize($data) ;
                 }
             }


                   }
               $imdb_id = "".$get->imdb_id ;
               $adult = "".$get->adult ;
               $status = "".$get->status;
               $first_date = "".$get->release_date ;
               $duretime = "".$get->runtime;
               $video = "".$get->video;
               $Lang = $get->original_language ;
               foreach ($get->production_countries as $key => $value) {
                  $Country = ($value->iso_3166_1 === "US") ? $value->iso_3166_1 : $value->iso_3166_1 ;
                }
                $Popular = $get->popularity ;
                $Rating = $get->vote_average ;

                //end name database

                  $url1 = "http://image.tmdb.org/t/p/w780".$get->poster_path;
                  $contents1 = file_get_contents($url1);
                //  $name = substr($url, strrpos($url, '/') + 1);
                          Storage::put('public/images/'.$namedir.''.$get->poster_path, $contents1, 'public');
                //
                //array database
                $arrayget = array( 'Title' => $get->title ,
                                   'Postimg' => $namedir.''.$get->poster_path,
                                   'Background' => $get->backdrop_path,
                                   'Gallery' => $Gallery,
                                   'Tempmdb' => $get->id,
                                   'Imdb_Id' => $imdb_id,
                                   'Adult' => "".$adult,
                                   'Status' => "".$status,
                                   'Video' => "".$video,
                                   'First_Date' => $first_date,
                                   'Country' => "".$Country,
                                   'Lang' => "".$Lang,
                                   'Popular' => "".$Popular,
                                   'Rating' => "".$Rating,
                                   'TimeEp' => "".$duretime,

                                      );

                //end array database
                //save Movies database

                $DbMovies->title = $get->title;
                $NameSlug= Str::slug($get->title , "-") ;

                if (strlen($NameSlug) > 3) {
                  $DbMovies->slug = $NameSlug;
                }else {
                  $DbMovies->slug = "movie-".$get->id;
                }


                $DbMovies->type = 'Movies';
                $DbMovies->content = $get->overview ;
                $DbMovies->user_id = Auth::user()->id;
               $DbMovies->tmdb_id = $get->id ;

                $DbMovies->timestamps;
                $DbMovies->save();
                foreach ($arrayget as $k1 => $v1) {
                  $Admin = new TVMeta;
                  $Admin->simokey = "Movie_".$k1 ;
                  $Admin->simovalue =  $v1 ;
                  $Admin->tv_id =  $DbMovies->id ;
                  $Admin->timestamps ;
                  $DbMovies->tvdata()->save($Admin);
                 }
                //end save Movies database

                foreach ( $get->genres  as $key => $value) {
                    $name = $value->name ;

                   $Categorys = Categorys::where('slug', Str::slug($name , "-"))->where('taxonomy', 'Tags')->first();


                  if (! isset($Categorys->name)) {

                         $Categorys = new Categorys ;
                         $Categorys->name = $name;
                         $Categorys->type = "Tags";
                         $Categorys->taxonomy = "Tags";
                         $Categorys->parent_id = "0";
                         $Categorys->slug = Str::slug($name , "-");
                         $Categorys->save();
                         $Categorys->timestamps;


                  }

                  if (isset($DbMovies->Tags) ) {
                  if (isset($DbMovies->Tags->where('cate_id', $Categorys->id)->first()->cate_id)) {
                  $catdata = $DbMovies->Tags->where('cate_id', $Categorys->id)->first()->cate_id ;
                  }else {
                  $catdata = 'null';
                  }
                  if ($catdata == $Categorys->id) { }
                  else {
                 foreach ($DbMovies->Tags as $key => $value) {
                          $value->forceDelete();
                    }
                    $CategorysMeta = new CategorysMeta ;
                    $CategorysMeta->cate_id = $Categorys->id;
                    $CategorysMeta->taxonomy = "Tags";
                    $CategorysMeta->type = "tvshows";
                    $CategorysMeta->type_id = $DbMovies->id;
                    $Categorys->catemeta()->save($CategorysMeta);
                          }
                  }

                }

                     $CategorysMeta1 = CategorysMeta::where('type_id', $DbMovies->id)->where('cate_id', $request->category)->first() ;

                     if (isset($CategorysMeta1)) {
                       $CategorysMeta1->cate_id = "1";
                       $CategorysMeta1->save();
                     }
                if (! isset($CategorysMeta1)) {

                        $CategorysMeta1 = new CategorysMeta ;
                        $CategorysMeta1->cate_id = "1";
                        $CategorysMeta1->taxonomy = "Categorys";
                        $CategorysMeta1->type = "tvshows";
                        $CategorysMeta1->type_id = $DbMovies->id;
                        $CategorysMeta1->save();
                      }



 return $get->id;
    }
    public function store1(Request $request, $id)
    {

        $DbMovies= new Movies;

             $Options = new MyClass2 ;
             $Options->DB='App\Options' ;
             $Options->Value='option_value' ;
             $link = "http://api.themoviedb.org/3/movie/";
             $linkpatch = $link.$id."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";

             $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));


             $gourl = $link.$id."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
             $dates = Carbon::now() ;
             $namedir='/'.$dates->year.'/'.$dates->month;

             if (isset($get->status_code)) {
              return back();
            }else {
              $images= json_decode(file_get_contents($gourl))->backdrops;

              //very link lang null to ar and en
              if (count($images) === 0) {
              $gourl = $link.$request->id_data."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=en,ar";
              $images= json_decode(file_get_contents($gourl))->backdrops;
              }

              //end very link lang null to ar and en
                for ($i=0; $i < count($images) ; $i++) {
                if ($i < 9) {
              // switch lang...
                    switch ($images[$i]->iso_639_1) {
                    case null:
                    $url = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                    $data[]= $namedir.$images[$i]->file_path ;
                      break;
                    case "en":
                    $url = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                    $data[]= $namedir.$images[$i]->file_path ;
                      break;
                    case "ar":
                    $url = "http://image.tmdb.org/t/p/w1280".$images[$i]->file_path;
                    $data[]= $namedir.$images[$i]->file_path ;


                  } //end switch lang...

                  $contents = file_get_contents($url);
                  $name = substr($url, strrpos($url, '/') + 1);
                          Storage::put('public/Backgrounds/'.$namedir.'/'.$images[$i]->file_path, $contents, 'public');

          }
          }
          //end for
          //name database
          if (isset($data)) {
             $Gallery = serialize($data) ;
          }

            }


         //name database
        $Gallery = serialize($data) ;
        $imdb_id = "".$get->imdb_id ;
        $adult = "".$get->adult ;
        $status = "".$get->status;
        $first_date = "".$get->release_date ;
        $duretime = "".$get->runtime;
        $video = "".$get->video;
        $Lang = $get->original_language ;
        foreach ($get->production_countries as $key => $value) {
           $Country = ($value->iso_3166_1 === "US") ? $value->iso_3166_1 : $value->iso_3166_1 ;
         }
         $Popular = $get->popularity ;
         $Rating = $get->vote_average ;

         //end name database

           $url1 = "http://image.tmdb.org/t/p/w780".$get->poster_path;
           $contents1 = file_get_contents($url1);
           $name = substr($url, strrpos($url, '/') + 1);
                   Storage::put('public/images/'.$namedir.''.$get->poster_path, $contents1, 'public');
         //
         //array database
         $arrayget = array( 'Title' => $get->title ,
                            'Postimg' => $namedir.''.$get->poster_path,
                            'Background' => $get->backdrop_path,
                            'Gallery' => $Gallery,
                            'Tempmdb' => $get->id,
                            'Imdb_Id' => $imdb_id,
                            'Adult' => "".$adult,
                            'Status' => "".$status,
                            'Video' => "".$video,
                            'First_Date' => $first_date,
                            'Country' => "".$Country,
                            'Lang' => "".$Lang,
                            'Popular' => "".$Popular,
                            'Rating' => "".$Rating,
                            'TimeEp' => "".$duretime,

                               );

         //end array database
         //save Movies database

         $DbMovies->title = $get->title;
         $DbMovies->slug = Str::slug($get->title , "-");
         $DbMovies->type = 'Movies';
         $DbMovies->content = $get->overview ;
         $DbMovies->user_id = Auth::user()->id;
        $DbMovies->tmdb_id = $get->id ;

         $DbMovies->timestamps;
         $DbMovies->save();
         foreach ($arrayget as $k1 => $v1) {
           $Admin = new TVMeta;
           $Admin->simokey = "Movie_".$k1 ;
           $Admin->simovalue =  $v1 ;
           $Admin->tv_id =  $DbMovies->id ;
           $Admin->timestamps ;
           $DbMovies->tvdata()->save($Admin);
          }
         //end save Movies database

         //dd(array_filter(explode (',',preg_replace("/\s+/", "", $request->Tags.","))));

         //dd(array_filter(explode (',',preg_replace("/\s+/", "", $request->Tags.","))));
         foreach ( $get->genres  as $key => $value) {
             $name = $value->name ;

            $Categorys = Categorys::where('slug', Str::slug($name , "-"))->where('taxonomy', 'Tags')->first();


           if (! isset($Categorys->name)) {

                  $Categorys = new Categorys ;
                  $Categorys->name = $name;
                  $Categorys->type = "Tags";
                  $Categorys->taxonomy = "Tags";
                  $Categorys->parent_id = "0";
                  $Categorys->slug = Str::slug($name , "-");
                  $Categorys->save();
                  $Categorys->timestamps;


           }

           if (isset($DbMovies->Tags) ) {
           if (isset($DbMovies->Tags->where('cate_id', $Categorys->id)->first()->cate_id)) {
           $catdata = $DbMovies->Tags->where('cate_id', $Categorys->id)->first()->cate_id ;
           }else {
           $catdata = 'null';
           }
           if ($catdata == $Categorys->id) { }
           else {
          foreach ($DbMovies->Tags as $key => $value) {
                   $value->forceDelete();
             }
             $CategorysMeta = new CategorysMeta ;
             $CategorysMeta->cate_id = $Categorys->id;
             $CategorysMeta->taxonomy = "Tags";
             $CategorysMeta->type = "tvshows";
             $CategorysMeta->type_id = $DbMovies->id;
             $Categorys->catemeta()->save($CategorysMeta);
                   }
           }

         }

              $CategorysMeta1 = CategorysMeta::where('type_id', $DbMovies->id)->where('cate_id', $request->category)->first() ;

              if (isset($CategorysMeta1)) {
                $CategorysMeta1->cate_id = "1";
                $CategorysMeta1->save();
              }
         if (! isset($CategorysMeta1)) {

                 $CategorysMeta1 = new CategorysMeta ;
                 $CategorysMeta1->cate_id = "1";
                 $CategorysMeta1->taxonomy = "Categorys";
                 $CategorysMeta1->type = "tvshows";
                 $CategorysMeta1->type_id = $DbMovies->id;
                 $CategorysMeta1->save();
               }
return $get->id;

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
