<?php
namespace App\MyClass;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 *
 */

 class SimoPhp
 {
   use SimoAllPhp ;
   use Seo ;
 }

trait SimoAllPhp
{

// Strart Add Data Api Auto Single :
  public function ApiOneAuto($id, $type, $api_tv, $season=null, $episode=null, $api_update=null)
  {


          if ($type === "tvshow") {
          $link = "tv/".$id ;
          $is_images = true ;
          }
          if ($type === "movie") {
          $link = "movie/".$id ;
          $is_images = true ;
          }
          if ($type === "season" && strlen($season) > 0) {
          $link = "tv/".$id."/season/".$season ;
          }
          if ($type === "episode" && strlen($season) > 0 && strlen($episode) > 0) {
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

      if (isset($body_arabic->success) && isset($body->success)) {
        if ($body_arabic->success == false && $body->success == false) {
        return null ;
        }
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
      $this->images($name_post,"remote",$api_tv,null,$api_update);
      }
      if (isset($body->backdrop_path) or isset($body_arabic->backdrop_path)) {
        $background = ($body->backdrop_path??$body_arabic->backdrop_path) ;
        $this->images($background,"remote",$api_tv,"background/",$api_update);
      }
      $data["Date_folder"]= $namedir ;
     if ($type === "tvshow" or $type === "movie") {
       //start info database
       $name_title = ($body_arabic->name??$body_arabic->title??null) ;
       $name_name = null ;
       if (preg_match('/[اأإء-ي]/ui', $name_title) or preg_match('/[A-Za-z]/ui', $name_title)) {
        $name_name = $name_title ;
       }
       $name_title_org = $body->name??$body_arabic->title??null ;
       $name_name_org = null ;
       if (preg_match('/[اأإء-ي]/ui', $name_title_org) or preg_match('/[A-Za-z]/ui', $name_title_org)) {
        $name_name_org = $name_title_org ;
       }
       $name_title_arabic = $body_arabic->name??$body_arabic->title??null ;
       $name_name_arabic = null ;
       if (preg_match('/[اأإء-ي]/ui', $name_title_arabic)) {
        $name_name_arabic = $name_title_arabic ;
       }
       $data["title_arabic"]= $name_name_arabic ;
       $data["title"]= $name_name ;
       $data["title_org"]= $name_name_org ;
       $data["info"]["title_arabic"]= Str::slug($data["title_arabic"], '-') ;
       $data["info"]["title"]= Str::slug($data["title"], '-')  ;
       $data["info"]["title_org"]= Str::slug($data["title_org"], '-') ;
       $data["tmdb_id"]= $body->id??null ;
       $data["imdb_id"]= $body->imdb_id??null ;
       $data["info"]["tmdb_id"]= $data["tmdb_id"] ;
       $data["info"]["imdb_id"]= $data["imdb_id"] ;
       $data["overview"]= $body_arabic->overview ;
       $data["info"]["Date_folder"]= $namedir ;
       $data["info"]["run_time"]= $body->episode_run_time[0]??($body->runtime??null) ;
       $data["info"]["first_date"]= $body->first_air_date??($body->release_date??null) ;
       //start image post and background
       if (isset($body->poster_path)) {
         $data["info"]["postimg"]= $namedir.$body->poster_path ;
       }
       if (isset($body->backdrop_path)) {
         $data["info"]["backdrop_img"]= $namedir.$body->backdrop_path ;
       }

       //end image post and background
       if ($type === "tvshow") {
         $data["info"]["last_date"]= $body->last_air_date??''  ;
         $data["info"]["episodes_nm"]= $body->number_of_episodes??'' ;
         $data["info"]["seasons_nm"]= $body->number_of_seasons??'' ;
         $data["info"]["next_dateep"]= $body->next_episode_to_air->air_date??''  ;
         //start networks
         $data["info"]["networks"]= null ;
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
      //end networks

       $data["info"]["status"]= $body->status ;
       //end info database
       $data["info"]["trailer"] = null ;
       if (count($link_trailer->results) > 0) {
         foreach ($link_trailer->results as $k => $v) {
          $trailer[$v->key] = $v->site ;
         }
         $data["info"]["trailer"] = json_encode($trailer) ;
         }

       //start rating
       $data["info"]["popular"]= $body->popularity ;
       $data["info"]["rating"]= $body->vote_average ;
       $data["info"]["vote_count"]= $body->vote_count ;
       //end rating

       //start Gallery
       $data["info"]["gallery"] = null ;
       $Gallery = json_decode(Http::get($link_tvshow_backgrands)->body());
       $Gallery = $Gallery->backdrops;
       $gallery = [] ;
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

       if (count($gallery) > 0) {
         $data["info"]["gallery"] = json_encode($gallery) ;
         // $url = $link_post.$images ;
         // $contents = Http::get($url)->body();
         // $name = substr($images, strrpos($images, '/') + 1);
       }
       //end switch lang...

       //dd($namedir.'/'.$name);
       // // save Storage folder
       //Storage::put('public/Backgrounds/'.$namedir.'/'.$name, $contents, 'public');
       // // end save Storage folder
       }
       }
       //end for
       //end Gallery


       // start genres tags
       if (count($body_arabic->genres) > 0) {
         foreach ($body_arabic->genres as $k => $v) {
         $data["genres_arabic"][$k] = $v->name ;
         $data["genres"][$k] = $body->genres[$k]->name ;
         }
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
     if (isset($body->poster_path)) {
       $data["postimg"]= $namedir.$body->poster_path ;
     }

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
       if (isset($body->still_path)) {
         $data["postimg"]= $namedir.$body->still_path ;
       }

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
public function images($request,$type,$tvshow,$folder=null,$update=null)
{
  if (isset($tvshow->tvdata) && isset($tvshow->tvdata->where('simokey', 'postimg')->first()->simovalue)) {
    $tvshow_img = $tvshow->tvdata->where('simokey', 'postimg')->first()->simovalue ;
  }else {
    $tvshow_img = null ;
  }

  $dates = Carbon::now() ;
  $namedir=($tvshow->folder_date)??('/'.$dates->year.'/'.$dates->month);

  if ($type == "upload") {
      $nameimg = $namedir.'/'.$request->addPhoto->getClientOriginalName() ;

      if ($nameimg !== $tvshow_img) {

        if (Storage::exists('public/'.$folder.$tvshow_img)) {
           Storage::disk('public')->delete($folder.$tvshow_img);
        }
        $request->file('addPhoto')->storeAs('public/'.$folder.$namedir,$request->addPhoto->getClientOriginalName());
        return $nameimg ;
      }
    }

  if ($type == "remote") {
    $name_background = str_ireplace("/", "", $request);
    $link_post = "http://image.tmdb.org/t/p/w1280/" ;
    $link_post_w300 = "http://image.tmdb.org/t/p/w300/" ;
    $link_post_w185 = "http://image.tmdb.org/t/p/w185/" ;
    $link_post_w154 = "http://image.tmdb.org/t/p/w154/" ;
    $link_post_w92 = "http://image.tmdb.org/t/p/w92/" ;
    $array_links = ["postimg_154" => $link_post_w154 ,"postimg"  => $link_post_w185,"images_300"  => $link_post_w300,"images"  => $link_post, "thumbnail" => $link_post_w92] ;

    if ($namedir.'/'.$name_background !== $tvshow_img) {
    foreach ($array_links as $key => $value) {
      $very = Storage::exists('public/'.$folder.$namedir.$key."/".$namedir.'/'.$name_background) ;
      $check = false ;
      if ($very == true) {
        if (isset($update)) {
        Storage::disk('public')->delete($folder.$key.$namedir.'/'.$name_background);
        $check = true ;
        }
      }else {
        $check = true ;
      }



      if (($check)) {
        $url_post_w92 = $value.$request ;
        $content_post_w92 = Http::get($url_post_w92)->body();
        $link = 'public/'.$folder.$key.$namedir.'/'.$name_background ;
        Storage::put($link, $content_post_w92, 'public');
      }
    }
  }
  return $namedir."/".$name_background ;
 }

}
public function PostData($request,$type,$tvshow)
{

  $dates = Carbon::now() ;
  $namedir=($tvshow->folder_date)??('/'.$dates->year.'/'.$dates->month);
  $nameimg=null;

  if (isset($request->addPhoto)) {

        $request->validate([
        'addPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $arrayget["postimg"] = $this->images($request,$tvshow,"upload","images") ;

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

    $db = new \App\Models\Categorys;
    $subdb = new \App\Models\CategorysMeta;


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

public function Categorys($Categorys,$type,$id,$names=null)
{
   $db = new \App\Models\Categorys;
   $subdb = new \App\Models\CategorysMeta;
   $Categorys1 = $db->find($Categorys);
   $very = $subdb->where('type_id', $id)
                 ->where('taxonomy', $names??'Categorys')
                 ->first() ;

  ////////////////////////////
  if (! isset($very) or isset($very)) {

     if (isset($very)) {
     $CategorysMeta1 = $very ;
   }else {
     $CategorysMeta1 = $subdb ;
   }

     $CategorysMeta1->cate_id = $Categorys1->id;

     if (! isset($very)) {
     $CategorysMeta1->taxonomy = $names??"Categorys";
     $CategorysMeta1->type = $type;
     $CategorysMeta1->type_id = $id;
     $Categorys1->catemeta()->save($CategorysMeta1);
  }else {
    $CategorysMeta1->save();
  }

   }
}
function link_check($value,$code=null)
{
  if ($code) {
  $link = $this->simodecrypt($value) ;
}else {
  $link = $value ;
}

  $filter_link = ["okgaming","okanime","openload","hydrax","vidzi","cloudy.ec","thevideo.me","estream.to","thevideo","thevideo"];
$true = null ;
  foreach ($filter_link as $v) {
    $filter_title =stripos($link,$v);
    if ($filter_title !== false) {
      $true = true ;
      break;
    }
  }
  return $true ;
}
function name_check($value,$link,$code=null)
{

  if (isset($code)) {
  $link = $this->simodecrypt($link) ;
}else {
  $link = $link;
}
 $filter_name = ["Ramen","سيرفر","أخرى","Server","المتوسطة","ال"];
  $myDomainName = null ;
  $true = false ;
  foreach ($filter_name as $v) {
    $filter_title =stripos($value,$v);
    if ($filter_title !== false) {
      $true = true ;
      $myParsedURL = parse_url($link);
      if (isset($myParsedURL['host'])) {
      $myDomainName= $myParsedURL['host'];
    }else {
      $true = false ;
    }
      break;
    }
  }

   if ($true) {
     $names = str_ireplace("www.", "", $myDomainName) ;
     $name = explode(".", $names);
     return ucwords($name[0]) ;
   }else {
     return $value ;
   }
}
public function serversdb($alldata,$datadb,$type,$type_server,$code=null)
{

  if (isset($alldata) &&  count($alldata) > 0 && isset($type)) {

  foreach ($alldata as $key => $value) {
    $DbTVshows = $datadb ;
    $Db = new \App\Models\Servers;

    $episode= $Db->where('type', $type)
               ->where('type_id', $DbTVshows->id)
               ->where('link', $value['link'])
               ->where('server_type', $type_server)
               ->first();
               //$this->link_check($value['link'],$code)
               //
// $utl = $this->link_check($value['link'],$code) ;
//
//    if (!$utl) {
      // code...
    if (!isset($episode->id) && strlen($value['link'])>= 3) {
      $Db->type = $type ;
      $Db->type_id = $DbTVshows->id ;
      $Db->user_id = $DbTVshows->user_id ;
      $Db->name = $this->name_check($value['name'],$value['link'],$code) ;
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

  //  }
  }
     }

}

public function GetVisitor($Request,$data,$type,$type_id)
{
  $Visitor = new \App\Models\Visitor ;
  $check = $Visitor->where('session_id', session()->getId());
  $check = $check->where('type', $type)->where('type_id', $type_id)->first();
  if (!isset($check)) {
    $Visitor->session_id =session()->getId() ;
    $Visitor->type = $type ;
    $Visitor->type_id = $type_id ;
    $Visitor->visitor = 1 ;
    $Visitor->ip = $Request->getClientIp() ;
    $Visitor->Agent = $Request->header('User-Agent') ;
    $Visitor->referrer = request()->headers->get('referer') ;
    $Visitor->save();
    $data->visitor = $Visitor->where('type', $type)->where('type_id', $type_id)->count() ;
    $data->save();
  }else {
    $check->visitor++ ;
    $check->save();
  }
}

function simodecrypt($string_to_decrypt, $type='base64') {
$key = md5("Simokh2020@@Anass&&");
if (strtolower($type)=='base64') {
    $string_to_decrypt = base64_decode($string_to_decrypt);
} else {
    $string_to_decrypt = hex2bin($string_to_decrypt);
}
// mcrypt_decrypt() DEPRECATED as of PHP 7.1.0 and REMOVED as of PHP 7.2.0
$rtn = openssl_decrypt($string_to_decrypt, 'bf-ecb', $key, true);
return($rtn);
}
}

trait Seo
{
   public $key ;
   public $name ;
   public function __construct($key=null,$name=null)
   {

       $this->key = $key;
       $this->name = $name;

   }

  public function seo_meta($cut=" | ")
  {

    $option = new \App\Models\Options ;
    $metaall = new \stdClass;
    $title = $option->where('option_name', 'Setting_NameSite')->value('option_value') or null ;
    $meta = $option->where('option_name', 'Setting_DescSite')->value('option_value') or null;
    if (isset($this->name) && isset($this->key)) {
    $title_seo = $option->where('option_name', $this->key)->value('option_value') or null;
    $title = str_ireplace('{id}', $this->name, $title.$cut.$title_seo) ;
    }
   else {
    $title = str_ireplace('{id}', $title, $title.$cut.$meta) ;
   }

    $metaall->title = $title ;
    $metaall->meta = $meta ;

    return $metaall ;

  }

}
