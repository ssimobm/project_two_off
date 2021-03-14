<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Movies;
use App\TVMeta;
use App\Servers;
use App\Categorys;
use App\CategorysMeta;
use App\Options;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexajax(Request $request ,$id)
     {

       if (isset($request)) {
         // code...
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

}if (! isset($request)) {
  return redirect()->guest('data/movies');
} {


}


         }
    public function index() {

      $simoo=Movies::where('type', 'Movies')->simplePaginate(12);

        return view('Movies.index',["data" => $simoo]);

 }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
$Categorys = Categorys::get();
 return view('Movies.Adds1',["Categorys" => $Categorys]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
       {


//dd(array_filter(explode (',',preg_replace("/\s+/", "", $request->Tags.","))));

       $DbMovies= new Movies;
       if (isset($request->idData) or isset($request->id_data)) {
      $Db= $DbMovies->where('tmdb_id', $request->id_data.$request->idData)->first();

    }

   // chek exist Movies TMDb
   if (isset($Db->tmdb_id) === False) {
//end Submit

$dates = Carbon::now() ;
$namedir='/'.$dates->year.'/'.$dates->month;
if ($request->Submit === "data") {

$nameimg="";
if (isset($request->addPhoto)) {
  $request->validate([
'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);
$dates = Carbon::now() ;
$namedir= $dates->year.'/'.$dates->month;
$request->file('addPhoto')->storeAs('public/images/'.$namedir,$request->addPhoto->getClientOriginalName());
$nameimg = $namedir.'/'.$request->addPhoto->getClientOriginalName() ;
}
   //array database
   $arrayget = array(
                      'Title' => "".$request->title_tv ,
                      'Postimg' => "".$nameimg,
                      'Background' => "null",
                      'Gallery' => "null",
                      'Tempmdb' => "".$request->idData,
                      'Imdb_Id' => "".$request->idImdb,
                      'Adult' => "".$request->adult,
                      'Status' => "".$request->status,
                      'Video' => "".$request->video,
                      'First_Date' =>"".$request->first_date,
                      'Country' => "".$request->country,
                      'Lang' => "".$request->lang,
                      'Popular' => "".$request->popular,
                      'Rating' => "".$request->rating,
                      'TimeEp' => "".$request->timeep,

                         );

   //end array database
   //save Movies database

   $DbMovies->title = $request->addTiltle;
   $DbMovies->slug = Str::slug($request->addTiltle , "-");
   $DbMovies->user_id = Auth::user()->id;

   $DbMovies->type = 'Movies';
   $DbMovies->content = $request->editor ;

   $DbMovies->tmdb_id = $request->idData ;


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
    //  return redirect('movies/edit/'.$DbMovies->id)->with('status', 'Profile updated!');
   //end save Movies database






   }//end Submit
   //start autodata
   if ($request->Submit === "AutoData") {

     $Options = new MyClass2 ;
     $Options->DB='App\Options' ;
     $Options->Value='option_value' ;
     $link = "http://api.themoviedb.org/3/movie/";
     $linkpatch = $link.$request->id_data."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
     $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));


     $gourl = $link.$request->id_data."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";
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


                   if (isset($Poster_Path)) {
             $images= "https://image.tmdb.org/t/p/w780/".$Poster_Path;
             $contents = file_get_contents($images);
             //$name = substr($images, strrpos($images, '/') + 1);
             Storage::put('public/images/'.$namedir."/".$Poster_Path, $contents);
                   $DbTVshows->Postimg = $namedir.'/'.$Poster_Path ;
                   }
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
   $DbMovies->user_id = Auth::user()->id;
 $DbMovies->type = 'Movies';
 $DbMovies->content = $get->overview ;

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
   //return redirect('movies/edit/'.$DbMovies->id)->with('status', 'Profile updated!');

  } //end autodata

  if ($request->Submit === "AutoData") {
  //dd($get->genres);
  $cate = $get->genres ;
  }else {
    $cate = array_filter(explode (',',preg_replace("/\s+/", "", $request->Tags.","))) ;
  }  if (! isset($cate)) {
      foreach ($DbMovies->Tags as $key => $value) {
               $value->forceDelete();
         }
    }
  //dd(array_filter(explode (',',preg_replace("/\s+/", "", $request->Tags.","))));
  foreach ($cate as $key => $value) {

    if ($request->Submit === "AutoData") {
  $name = $value->name ;
  }else {
  $name = $value ;
  }

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
         $CategorysMeta = new CategorysMeta ;
         $CategorysMeta->cate_id = $Categorys->id;
         $CategorysMeta->taxonomy = "Tags";
         $CategorysMeta->type = "tvshows";
         $CategorysMeta->type_id = $DbMovies->id;
         $Categorys->catemeta()->save($CategorysMeta);

            }
    }

  }
       $Categorys1 =Categorys::where('id', $request->category)->where('taxonomy', 'Categorys')->first();

  if (! isset($Categorys1->catemeta)) {

          $CategorysMeta1 = new CategorysMeta ;
          $CategorysMeta1->cate_id = $Categorys1->id;
          $CategorysMeta1->taxonomy = "Categorys";
          $CategorysMeta1->type = "tvshows";
          $CategorysMeta1->type_id = $DbMovies->id;
          $Categorys1->catemeta()->save($CategorysMeta1);
        }
    return redirect('movies/edit/'.$DbMovies->id)->with('status', 'Profile updated!');
 } //end

return redirect('movies/edit/'.$Db->id)->with('status', 'Profile updated!');
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
    public function edit($Movies)
    {
      $DbMovies = Movies::where('type', 'Movies')->where('id', $Movies)->firstOrFail();
$Tags = $DbMovies->Tags;
$Categorys = Categorys::where('taxonomy', 'Categorys')->get();

// foreach ($DbMovies->Tags->where('taxonomy', 'Tags')->all() as $key => $value) {
//   $Tags[] = $value->Tags->first()->name ;
// echo $value->Tags->first()->name."<br>";
// }
// dd($Tags);
// foreach ($Tags->where('taxonomy', 'Tags')->all() as $key => $value) {
//
//   $simo[] = $value->Categorys->firstWhere ('id', $value->cate_id)->name ;
//
// }
//   dd($simo);
      $Data = $DbMovies->tvdata;

      //$test = $Data->where('simokey', 'Movie_Title')->first();
//dd($test);
      return view('Movies.edit',["movies" => $DbMovies,"Data" => $Data,"Categorys" => $Categorys]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Movies)
    {


             $DbMovies = Movies::find($Movies);
             if (isset($request)) {
            $is_Db = $request->Submit === "data" ? $request->idData : $request->id_data;

            $Db= $DbMovies->where('tmdb_id', $is_Db)->first();

            if (isset($Db->id)) {
              if ($Db->id != $Movies) {
              return back();
              }
            }
          }


      //end Submit
      $dates = Carbon::now() ;
      $namedir='/'.$dates->year.'/'.$dates->month;
      if ($request->Submit === "data") {

      $nameimg= $DbMovies->tvdata->where('simokey', 'Movie_Postimg')->first()->simovalue;

      if (isset($request->addPhoto)) {
        $request->validate([
      'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      $dates = Carbon::now() ;
      $namedir= $dates->year.'/'.$dates->month;
      $request->file('addPhoto')->storeAs('public/images/'.$namedir,$request->addPhoto->getClientOriginalName());
      $nameimg = $namedir.'/'.$request->addPhoto->getClientOriginalName() ;
      }
$nameprefix = "Movie_";
         //array database
         $arrayget = array(
                          $nameprefix.'Title' => $request->title_tv ,
                          $nameprefix.'Postimg' => "".$nameimg,

                          $nameprefix.'Tempmdb' => $request->idData,
                          $nameprefix.'Imdb_Id' => $request->idImdb,
                          $nameprefix.'Adult' => "".$request->adult,
                          $nameprefix.'Status' => "".$request->status,
                          $nameprefix.'Video' => "".$request->video,
                          $nameprefix.'First_Date' => $request->first_date,
                          $nameprefix.'Country' => "".$request->country,
                          $nameprefix.'Lang' => "".$request->lang,
                          $nameprefix.'Popular' => "".$request->popular,
                          $nameprefix.'Rating' => "".$request->rating,
                          $nameprefix.'TimeEp' => "".$request->timeep,

                               );

         //end array database
         //save Movies database
         $DbMovies = Movies::find($Movies);

         $DbMovies->title = $request->addTiltle;
         $DbMovies->type = 'Movies';
         $DbMovies->content = $request->editor ;

$DbMovies->tmdb_id = $request->idData ;

         $DbMovies->timestamps;
         $DbMovies->save();
         foreach ($arrayget as $k1 => $v1) {
           if (isset($v1)) {


           foreach ($DbMovies->tvdata as $key => $value) {

if ($k1 === $value->simokey) {

           $Admin = TVMeta::where('id', $value->id)->first();
           $Admin->simokey = $k1 ;
           $Admin->simovalue =  $v1 ;
           $DbMovies->tvdata()->save($Admin);
}}

         } }
         //end save Movies database






         }//end Submit


         //start autodata
         if ($request->Submit === "AutoData") {

           $Options = new MyClass2 ;
           $Options->DB='App\Options' ;
           $Options->Value='option_value' ;
           $link = "http://api.themoviedb.org/3/movie/";
           $linkpatch = $link.$request->id_data."?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=".$Options->Simo_Op('option_name','tmdb_lang')."";
           $get= json_decode(file_get_contents($linkpatch ,false, stream_context_create(['http' => ['ignore_errors' => true]])));
$Gallery="";
           $gourl = $link.$request->id_data."/images?api_key=".$Options->Simo_Op('option_name','tmdb_api')."&language=null";

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


       //end name database
       if (isset($get->poster_path)) {
         $url1 = "http://image.tmdb.org/t/p/w780".$get->poster_path;
         $contents1 = file_get_contents($url1);
        // $name = substr($url, strrpos($url, '/') + 1);
                 Storage::put('public/images/'.$namedir.''.$get->poster_path, $contents1, 'public');
       //
       }


       //array database
       $nameprefix = "Movie_";
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
        $arrayget = array( $nameprefix.'Title' => $get->title ,
                        $nameprefix.'Postimg' => $namedir.''.$get->poster_path,
                        $nameprefix.'Background' => $get->backdrop_path,
                        $nameprefix.'Gallery' => $Gallery,
                        $nameprefix.'Tempmdb' => $get->id,
                        $nameprefix.'Imdb_Id' => $imdb_id,
                        $nameprefix.'Adult' => "".$adult,
                        $nameprefix.'Status' => "".$status,
                        $nameprefix.'Video' => "".$video,
                        $nameprefix.'First_Date' => $first_date,
                        $nameprefix.'Country' => "".$Country,
                        $nameprefix.'Lang' => "".$Lang,
                        $nameprefix.'Popular' => "".$Popular,
                        $nameprefix.'Rating' => "".$Rating,
                        $nameprefix.'TimeEp' => "".$duretime,

                              );
       //end array database
       //save Movies database

      $DbMovies = Movies::find($Movies);
       $DbMovies->title = $get->title;
       $DbMovies->type = 'Movies';
       $DbMovies->content = $get->overview ;
$DbMovies->tmdb_id = $get->id ;

       $DbMovies->timestamps;
       $DbMovies->save();
       foreach ($arrayget as $k1 => $v1) {
         if (isset($v1)) {


         foreach ($DbMovies->tvdata as $key => $value) {

if ($k1 === $value->simokey) {

         $Admin = TVMeta::where('id', $value->id)->first();
         $Admin->simokey = $k1 ;
         $Admin->simovalue =  $v1 ;
         $DbMovies->tvdata()->save($Admin);
}}

       } }
       //end save Movies database
        } //end autodata


        if ($request->Submit === "AutoData") {
        //dd($get->genres);
        $cate = $get->genres ;

        }else {
          $cate = array_filter(explode (',',$request->Tags.",")) ;
        }

        if (! isset($request->Tags) and ! isset($get->genres)) {
          foreach ($DbMovies->Tags->where('taxonomy', 'Tags') as $key => $value) {
                   $value->forceDelete();
             }
        }


        foreach ($cate as $key => $value) {


          if ($request->Submit === "AutoData") {
        $name = $value->name ;
        }else {
        $name = $value ;
        }

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


          if ($DbMovies->Tags) {
            foreach ($DbMovies->Tags->where('taxonomy', 'Tags') as $v) {
            $v->forceDelete();

            }
            $CategorysMeta = new CategorysMeta ;
            $CategorysMeta->cate_id = $Categorys->id;
            $CategorysMeta->taxonomy = "Tags";
            $CategorysMeta->type = "tvshows";
            $CategorysMeta->type_id = $DbMovies->id;
            $Categorys->catemeta()->save($CategorysMeta);
          }

        }

             $CategorysMeta1 = CategorysMeta::where('type_id', $DbMovies->id)->where('taxonomy',"Categorys")->first() ;

             if (isset($CategorysMeta1)) {
               $CategorysMeta1->cate_id = $request->category;
               $CategorysMeta1->save();
             }
        if (! isset($CategorysMeta1)) {

                $CategorysMeta1 = new CategorysMeta ;
                $CategorysMeta1->cate_id = $request->category;
                $CategorysMeta1->taxonomy = "Categorys";
                $CategorysMeta1->type = "tvshows";
                $CategorysMeta1->type_id = $DbMovies->id;
                $CategorysMeta1->save();
              }




        if (isset($request->se_data) and isset($request->se_data['player'])) {
        //dd($request->se_data);
        //  $messages = [
        //       'se_data.player.*.link.required' => 'ccccccccccccccc',
        //       'se_data.player.*.name.required' => 'aaaaaaaaaaa',
        //   ];


        // $rules = [
          //         "se_data.player"    => "required|array",
          //         'se_data.player.*.link' => 'required|string|distinct|min:3',
          //         'se_data.player.*.name' => 'required|string|distinct|min:3',
          //       ];

        // $validator = Validator::make( $request->all(), $rules, $messages );
        // if ($validator->fails()) {
            //         return back()
              //                   ->withErrors($validator)
              //                   ->withInput();
              //   }
        $validator =  $this->validate($request, [
              "se_data.player"    => "required|array",
             'se_data.player.*.link' => 'required|string|distinct|min:3',
            'se_data.player.*.name' => 'required|string|distinct|min:3',

          ]);
        //  foreach ($request->se_data['player'] as $key => $value) {
        //    echo $value["name"];
          //  echo $value["link"]."<br>";
        //  }

        //dd(serialize($request->se_data));

          $Db = new Servers;
          $Dbget= $Db->where('type_id', $DbMovies->id)->where('se_type', 'player')->first();
          $Dbget1= $Db->where('type_id', $DbMovies->id)->where('se_type', 'download')->first();

          if (isset($Dbget->id) === False) {
            $Db->type = "movies" ;
            $Db->type_id = $DbMovies->id ;
            $Db->user_id = "1" ;
            $Db->Name = "movies_".$DbMovies->id."" ;
            $Db->Links = serialize($request->se_data) ;
            $Db->se_type = 'player' ;
            $Db->timestamps ;
            $DbMovies->server()->save($Db);
          }else {
            $Dbget->Links = serialize($request->se_data) ;
            $Dbget->timestamps ;
            $DbMovies->server()->save($Dbget);
          }

          if (isset($Dbget1->id) === False) {

            $Db->type = "movies" ;
            $Db->type_id = $DbMovies->id ;
            $Db->user_id = "1" ;
            $Db->Name = "movies_".$DbMovies->id."" ;
            $Db->Links = serialize($request->se_down) ;
            $Db->se_type = 'download' ;
            $Db->timestamps ;
            $DbMovies->server()->save($Db);
          }else {

            $Dbget1->Links = serialize($request->se_down) ;
            $Dbget1->timestamps ;
            $DbMovies->server()->save($Dbget1);
          }
             }
  return back();
             }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($movies)
     {
       $user1 = Movies::where('type', 'Movies')->Where('id' ,$movies)->firstOrFail();
       $user3 = $user1->tvdata()->delete();
       $user1->delete();
       return back();
     }
     public function restore($movies)
     {
       $user1 = Movies::onlyTrashed()->where('type', 'Movies')->Where('id' ,$movies)->firstOrFail();
       $user3 = $user1->tvdata()->restore();
       $user1->restore();
       return back();
     }
     public function destroy($movies)
     {
       $user1 = Movies::onlyTrashed()->where('type', 'Movies')->Where('id' ,$movies)->firstOrFail();
       $user1->forceDelete();
       $user1->tvdata()->forceDelete();
       return back();


     }public function alldestroy()
     {
       $user1 = Movies::onlyTrashed()->where('type', 'Movies')->get();

       foreach ($user1 as $key => $value) {

         $value->forceDelete();

         $value->tvdata()->forceDelete();
        // return back();
       }



     }
     public function showdalet()
       {
         $user1 = Movies::onlyTrashed()->where('type', 'Movies')->simplePaginate(12);
       return view('Movies.Trashed',["data" => $user1]);


       }
}
