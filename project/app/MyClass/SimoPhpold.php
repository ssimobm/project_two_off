<?php
namespace App\MyClass;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 *
 */
class SimoPhpold
{

// Strart Add Data Api Auto Single :
  public function ApiOneAuto($id, $type, $season=null, $episode=null)
  {


          if ($type === "tvshow") {
          $link = "tv/".$id ;
          $link_post = "http://image.tmdb.org/t/p/w1280" ;
          $is_images = true ;
          }
          if ($type === "movie") {
          $link_post = "http://image.tmdb.org/t/p/w1280" ;
          $link = "movie/".$id ;
          $is_images = true ;
          }
          if ($type === "season" && strlen($season) > 0) {
          $link_post = "http://image.tmdb.org/t/p/w1280" ;
          $link = "tv/".$id."/season/".$season ;
          }
          if ($type === "episode" && strlen($season) > 0 && strlen($episode) > 0) {
          $link_post = "http://image.tmdb.org/t/p/w1280" ;
          $link = "tv/".$id."/season/".$season."/episode/".$episode ;
          }

         if (isset($link)) {
         $link_tv = "https://api.themoviedb.org/3/".$link;
         // English body
         $link_tvshow = $link_tv."?api_key=00ca1e20cbfd8eec3248ebed03147cee&language=en-US";
         $body = json_decode(Http::get($link_tvshow)->body());
        // arabic body
        $link_tvshow_arabic = $link_tv."?api_key=00ca1e20cbfd8eec3248ebed03147cee&language=ar-SA";
        $body_arabic = json_decode(Http::get($link_tvshow_arabic)->body());
      }else {
      $body_arabic = null ;
      $body = null ;
      }

      if (isset($is_images)) {
        $link_tvshow_backgrands = $link_tv."/images?api_key=00ca1e20cbfd8eec3248ebed03147cee&language=null,en,ar";
        $link_trailer = json_decode(Http::get($link_tv."/videos?api_key=00ca1e20cbfd8eec3248ebed03147cee&language=en-US")->body());
      }

      //Start date folder
      $dates = Carbon::now() ;
      $namedir='/'.$dates->year.'/'.$dates->month;
      //end date folder
      if (isset($body->poster_path) or isset($body->still_path)) {
      $name_post = substr($body->poster_path??$body->still_path, strrpos($body->poster_path??$body->still_path, '/') + 1);
      $check_post_image = Storage::exists('public/images/'.$namedir.'/'.$name_post) ;
      if (!$check_post_image) {
      $url_post = $link_post.($body->poster_path??$body->still_path) ;
      $content_post = Http::get($url_post)->body();
      // save Storage post image
      Storage::put('public/images/'.$namedir.'/'.$name_post, $content_post, 'public');
      // end save post image
      }

      }
      $data["Date_folder"]= $namedir ;
     if ($type === "tvshow" or $type === "movie") {
       //start info database

       $data["title"]= $body_arabic->name??$body_arabic->title ;
       $data["title_org"]= $body->name??$body_arabic->title ;
       $data["tmdb_id"]= $body->id ;
       $data["imdb_id"]= $body->imdb_id??null ;
       $data["overview"]= $body_arabic->overview ;
       $data["info"]["Date_folder"]= $namedir ;
       $data["info"]["run_time"]= $body->episode_run_time[0]??$body->runtime ;
       $data["info"]["first_date"]= $body->first_air_date??$body->release_date ;
       //start image post and background
       $data["info"]["postimg"]= $namedir.$body->poster_path ;
       $data["info"]["backdrop_img"]= $namedir.$body->backdrop_path ;
       //end image post and background
       if ($type === "tvshow") {
         $data["info"]["last_date"]= $body->last_air_date??''  ;
         $data["info"]["episodes_nm"]= $body->number_of_episodes??'' ;
         $data["info"]["seasons_nm"]= $body->number_of_seasons??'' ;
         $data["info"]["next_dateep"]= $body->next_episode_to_air->air_date??''  ;
         if (count($body->networks) > 0) {
           foreach ($body->networks as $k => $v) {
            $network[$k]["name"]= $v->name ;
            $network[$k]["image"]= $v->logo_path ;
           }
           $data["info"]["networks"]= json_encode($network) ;
         }
       }else {
         $data["info"]["adult"]= $body->adult??''  ;
       }

       $data["info"]["status"]= $body->status ;
       //end info database
       if (count($link_trailer->results) > 0) {
         foreach ($link_trailer->results as $k => $v) {
          $trailer[$v->key] = $v->site ;
         }
         $data["info"]["trailer"] = json_encode($trailer) ;
         }
       //start networks


       //end networks
       //start rating
       $data["info"]["popular"]= $body->popularity ;
       $data["info"]["rating"]= $body->vote_average ;
       $data["info"]["vote_count"]= $body->vote_count ;
       //end rating

       //start Gallery
       $Gallery = json_decode(Http::get($link_tvshow_backgrands)->body());
       $Gallery = $Gallery->backdrops;
       //end very link lang null to ar and en
       for ($i=0; $i < count($Gallery) ; $i++) {
       if ($i < 9) {
       // switch lang...
       switch ($Gallery[$i]->iso_639_1) {
       case null:
       $images = $Gallery[$i]->file_path;
       $gallery[$i]= $namedir.$Gallery[$i]->file_path ;
         break;
       case "en":
       $images = $Gallery[$i]->file_path;
       $gallery[$i]= $namedir.$Gallery[$i]->file_path ;
         break;
       case "ar":
       $images = $Gallery[$i]->file_path;
       $gallery[$i]= $namedir.$Gallery[$i]->file_path ;


       }
       $data["info"]["gallery"] = json_encode($gallery) ;
       //end switch lang...
       $url = $link_post.$images ;
       $contents = Http::get($url)->body();
       $name = substr($images, strrpos($images, '/') + 1);
       //dd($namedir.'/'.$name);
       // // save Storage folder
       //Storage::put('public/Backgrounds/'.$namedir.'/'.$name, $contents, 'public');
       // // end save Storage folder
       }
       }
       //end for
       //end Gallery


       // start genres tags

       foreach ($body_arabic->genres as $k => $v) {
       $data["genres_arabic"][$k] = $v->name ;
       $data["genres"][$k] = $body->genres[$k]->name ;
       }
       // end genres tags
       // start language and country
       $nameContry[0] = '' ;
       if (is_array($body->production_countries)) {
         foreach ($body->production_countries as $k => $v) {
         if ($v->iso_3166_1 == 'US') {
         $nameContry[0] = $v->iso_3166_1 ;
         }
         else {
         $nameContry[0] = $v->iso_3166_1 ;
         }
         }
       }
       $data["info"]["country"]= $body->origin_country[0]??$nameContry[0] ;
       $data["info"]["language"]= $body->languages[0]??$body->original_language ;
       $data["info"]["language_org"]= $body->original_language ;
       // end language and country

       // start seasons info
       if (isset($body_arabic->seasons)) {
       $data["seasons"]= $body_arabic->seasons ;
       }
       // end seasons info
     }
     // add season
     if ($type === "season" && strlen($season) > 0) {
     $data["title"]= $body_arabic->name;


     $data["first_date"]= $body->air_date??null ;
     $data["overview"]= $body_arabic->overview ;
     $data["season_nm"]= $body_arabic->season_number ;
     $data["episode_nm"]= count($body->episodes);
     //start image post and background
     $data["postimg"]= $namedir.$body->poster_path ;
     //end image post and background
     }
     // add episode
     if ($type === "episode" && strlen($season) > 0 &&  strlen($episode) > 0) {

       $data["title"]= $body_arabic->name;
       $data["first_date"]= $body->air_date??null ;
       $data["overview"]= $body_arabic->overview ;
       $data["season_nm"]= $body_arabic->season_number ;
       $data["episode_nm"]= $body_arabic->episode_number ;
       //start image post and background
       $data["postimg"]= $namedir.$body->still_path ;
       //end image post and background
       //start rating
       $data["rating"]= $body->vote_average ;
       $data["vote_count"]= $body->vote_count ;
       //end rating

     }






      //return response()->json($data,200) ;
      return $data ;
  }
////////////////////////////////////
public function PostData($request,$type)
{

  $dates = Carbon::now() ;
  $namedir='/'.$dates->year.'/'.$dates->month;


  $nameimg="";
  if (isset($request->addPhoto)) {
    $request->validate([
  'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);
  $request->file('addPhoto')->storeAs('public/images/'.$namedir,$request->addPhoto->getClientOriginalName());
  $nameimg = $namedir.'/'.$request->addPhoto->getClientOriginalName() ;
  $arrayget["postimg"] = $nameimg ;
  }

  if ($type === "tvshow") {
    $arrayget["networks"]= $request->Network  ;
    $arrayget["last_date"]= $request->last_date  ;
    $arrayget["episodes_nm"]= $request->Ep_nm ;
    $arrayget["seasons_nm"]= $request->Sea_nm ;
    $arrayget["next_dateep"]= $request->next_date_ep  ;
  }else {
    $arrayget["adult"]= $request->Adult  ;
  }

  //array database
  $arrayget["date_folder"] = $namedir ;

  $arrayget["backdrop_img"] = "null" ;
  $arrayget["gallery"] = "null" ;
  $arrayget["status"] = $request->Status ;
  $arrayget["trailer"] = $request->Video ;
  $arrayget["first_date"] = $request->FirstDate ;
  $arrayget["country"] = $request->Country ;
  $arrayget["language"] = $request->Language ;
  $arrayget["language_org"] = $request->LanguageOrg ;
  $arrayget["popular"] = $request->Popular ;
  $arrayget["rating"] = $request->Rating ;
  $arrayget["vote_count"] = $request->VoteCount ;
  $arrayget["run_time"] = $request->Timeep ;

return $arrayget ;
}

public function Tags($tags,$type,$DbMovies)
{

  if (!is_array($tags)) {
  $tags = explode(",", $tags);
  }
  $tags = array_filter($tags);


  foreach ($tags as $k => $name) {

    $db = new \App\Categorys;
    $subdb = new \App\CategorysMeta;


      $name = trim($name," ") ;
      $slug = Str::slug($name , "-") ;
      $Categorys = $db->where('slug', $slug)->where('taxonomy', 'Tags')->first();


     if (! isset($Categorys->name) && $type) {

           $Categorys = $db ;
           $Categorys->name = $name;
           $Categorys->type = "Tags";
           $Categorys->taxonomy = "Tags";
           $Categorys->parent_id = "0";
           $Categorys->slug = $slug;
           $Categorys->timestamps;
           $Categorys->save();
      }

      $MetaCategorys = $subdb ;
      $check = $MetaCategorys
               ->where('cate_id',$Categorys->id)
               ->where('type', $type)
               ->where('taxonomy', 'Tags')
               ->where('type_id', $DbMovies->id)
               ->first() ;

               // foreach ($DbMovies->Tags->where('taxonomy', 'Tags') as $key => $Tags) {
               //     $Tags->delete();
               //     $Tags->forceDelete();
               // }
               //
               //   $MetaCategorys->type = $type;
               //   $MetaCategorys->type_id = $DbMovies->id;
               //   $MetaCategorys->taxonomy = "Tags";
               //   $Categorys->catemeta()->save($MetaCategorys);
      if (!isset($check->id) ) {
        $MetaCategorys->type = $type;
        $MetaCategorys->type_id = $DbMovies->id;
        $MetaCategorys->taxonomy = "Tags";
        $Categorys->catemeta()->save($MetaCategorys);
      }


  }
}

public function Categorys($Categorys,$type,$id)
{
   $db = new \App\Categorys;
   $subdb = new \App\CategorysMeta;
   $Categorys1 = $db->find($Categorys);
  ////////////////////////////
  if (! isset($Categorys1->catemeta) && $id) {

     $CategorysMeta1 = $subdb ;
     $CategorysMeta1->cate_id = $Categorys1->id;
     $CategorysMeta1->taxonomy = "Categorys";
     $CategorysMeta1->type = $type;
     $CategorysMeta1->type_id = $id;
     $Categorys1->catemeta()->save($CategorysMeta1);
   }
}


public function serversdb($alldata,$datadb,$type,$type_server)
{

  if (isset($alldata) &&  count($alldata) > 0 && isset($type)) {

  foreach ($alldata as $key => $value) {
    $DbTVshows = $datadb ;
    $Db = new \App\Servers;
    $episode= $Db->where('type', $type)
               ->where('type_id', $DbTVshows->id)
               ->where('link', $value['link'])
               ->where('server_type', $type_server)
               ->first();

    if (!isset($episode->id) && strlen($value['link'])>= 3) {
      $Db->type = "episode" ;
      $Db->type_id = $DbTVshows->id ;
      $Db->user_id = $DbTVshows->user_id ;
      $Db->name = $value['name'] ;
      $Db->link = $value['link'] ;
      $Db->quality = $value['quality'] ;
      $Db->server_type = $type_server ;
      $Db->timestamps ;
      $DbTVshows->server()->save($Db);

    }else {
      $episode->name = $value['name'] ;
      $episode->link = $value['link'] ;
      $episode->quality = $value['quality'] ;
      $episode->save();
    }

  }
     }

}

}
