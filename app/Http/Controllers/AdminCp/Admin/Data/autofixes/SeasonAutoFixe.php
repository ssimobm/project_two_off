<?php
namespace App\Http\Controllers\AdminCp\Admin\Data\autofixes;
use App\Http\Controllers\Controller;
use App\MyClass\MyFunction;
use Storage;
use Carbon\Carbon;
use App\Models\New_Movies;
use App\Models\New_Movies_Meta;
use App\Models\New_Tvshows;
use App\Models\New_Tvshows_Meta;
use App\Models\Season;
use App\Models\Seasons;
use App\Models\Episodes;
use App\Models\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;
//use App\Models\MyClass\MyFunction;
use App\MyClass\SimoPhp;

class SeasonAutoFixe extends Controller
{


  // public function __construct(User $user)
  // {
  //   $this->middleware('admin');
  //   $this->middleware('siteonline');
  //   $this->middleware('views')->only('index') ;
  //   $this->middleware('create')->only('create','store') ;
  //   $this->middleware('edit')->only('edit','update') ;
  //   $this->middleware('delete')->only('delete') ;
  //   //$this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');
  //
  // }
  public function index($id)
  {
    $link = New_Tvshows::find($id);
    //$user = Seasons::paginate(24);
    $user = $link;
    return view('admincp.fixbrowse.tvshows',['data' => $user]);
  }

  public function update(Request $request)
  {

    $arraySeason = explode(",", $request->array);
    $SeasonId = $arraySeason[0] ;
    $Season = Seasons::find($SeasonId);
    foreach ($arraySeason as $key => $value) {
      $Seasons = Seasons::find($value);
      if ($key != 0 && $Season->id !== $Seasons->id ) {
        foreach ($Seasons->episode->all() as $ep => $episode) {
          $episode->tv_id = $Season->tv_id ;
          $episode->sea_id = $Season->id ;
          $episode->season_nm = $Season->season_nm ;
          $episode->save();
        }
        $Seasons->delete();
        $Seasons->forceDelete();
      }

    }

    // foreach ($Season->episode->all() as $ep => $episode) {
    //   $arrayList = $episode->where('sea_id', $episode->sea_id)->where('episode_nm', $episode->episode_nm)->get();
    //
    //   foreach ($arrayList as $v_ep => $v_episode) {
    //     if ($v_episode->id != $episode->id) {
    //       foreach ($v_episode->server as $ser => $server) {
    //         $server->type_id = $episode->id ;
    //         $server->save();
    //       }
    //       if (count($v_episode->server) == 0) {
    //         $v_episode->delete();
    //         $v_episode->forceDelete();
    //
    //       }
    //
    //     }
    //   }
    //
    // }

return back();
  }
  public function SlugToName($name1,$nm,$title=null)
  {
    $name1 = str_ireplace(" Siend", "", $name1) ;

    $name = explode("Season", $name1);
    if ($title == "name") {
      $names = $name[0];
      if (strlen($names) == 0) {
      $names = str_ireplace("Season ".$nm, "", $name1) ;
      }
    }else {
      $name = explode(" ", $name[0]);
      $name = array_filter($name);
      if (isset($name[2])) {
      $names = $name[0].' '.$name[1].' '.$name[2] ;
      }
      else if (isset($name[1])) {
      $names = $name[0].' '.$name[1] ;
      }
      else {
        $names = str_ireplace("Season ".$nm, "", $name1) ;

      }
    }
       $names = str_ireplace("Season ".$nm, "", $names) ;
    return trim(preg_replace('/[^\p{P} a-z0-9]/ui', '', $names)) ;
  }
  public function search_cute(Request $request)
  {
    $link = New_Tvshows::find($request->id)->seasons;

    foreach ($link->all() as $key => $value) {
    $New_Tvshows_Meta = new New_Tvshows_Meta;
    if (isset($value->name)) {
      $name = Str::slug($this->SlugToName($value->name,$value->season_nm), '-') ;
      $tvshows_Meta = $New_Tvshows_Meta
                      ->Where('simokey','title')
                      ->Where('simovalue', 'like' , '%'.$name.'%')
                      ->first();
      if (!isset($tvshows_Meta->simovalue)) {
        $tvshows_Meta = $New_Tvshows_Meta
                      ->Where('simokey','title_arabic')
                      ->Where('simovalue', 'like' , '%'.$name.'%')
                      ->first();
      }
      if (!isset($tvshows_Meta->simovalue)) {
        $tvshows_Meta = $New_Tvshows_Meta
                      ->Where('simokey','title_org')
                      ->Where('simovalue', 'like' , '%'. $name.'%')
                      ->first();
      }
      if (!isset($tvshows_Meta->simovalue)) {
        $tvshows_Meta = $New_Tvshows_Meta
                      ->Where('simokey','title_old')
                      ->Where('simovalue', 'like' , '%'.$name.'%')
                      ->first();
      }
      $tvshows = new New_Tvshows;
    //  dd($tvshows_Meta,$name,$this->SlugToName($value->name,$value->season_nm,"name"),$value);
if (!isset($tvshows_Meta->tv_id)) {
  $tvshows->user_id = $value->user_id ;
  $tvshows->title = $this->SlugToName($value->name,$value->season_nm,"name") ;
  $tvshows->title_arabic = $this->SlugToName($value->name,$value->season_nm,"name") ;
  $tvshows->title_org = $this->SlugToName($value->name,$value->season_nm,"name") ;
  $tvshows->title_old = trim(str_ireplace("Season ".$value->season_nm, "", $value->name)) ;
  $tvshows->slug = Str::slug($this->SlugToName($value->name,$value->season_nm,"name"), '-') ;
  $tvshows->tmdb_id = $value->tmdb_id ;
  $tvshows->imdb_id = $value->imdb_id ;
  $tvshows->folder_date = $value->folder_date ;
  $tvshows->content = strlen($value->overview) > 1 ? $value->overview : null;
  $tvshows->type = $value->tvshow->type ;
  $tvshows->save();
  $meta["title"] = $tvshows->title ;
  $meta["title_arabic"] = $tvshows->title_arabic ;
  $meta["title_org"] = $tvshows->title_org ;
  $meta["title_old"] = $tvshows->title_old ;
  foreach ($meta as $key => $value) {
    $tvshows_meta = new New_Tvshows_Meta;
    $tvshows_meta->simokey = $key ;
    $tvshows_meta->simovalue = Str::slug($value, '-');
    $tvshows_meta->type = "tvshows" ;
    $tvshows_meta->user_id =  $tvshows->user_id ;
    $tvshows_meta->tv_id = $tvshows->id ;
    $tvshows->tvdata()->save($tvshows_meta);
  }
}else {
  $slug = Str::slug($this->SlugToName($value->name,$value->season_nm,"name"), '-') ;
  $tvshows = $tvshows->where('slug', "like" , "%".$slug."%")->first()  ;
}

if (isset($tvshows->id) && isset($value->tv_id)) {

  $value->tv_id = $tvshows->id ;
  $value->tvshow_slug = $tvshows->slug ;
  $value->tvshow_img = ($tvshows->tvdata->where('simokey', 'postimg')->first()->simovalue)??null;
  $value->tvshow_backimg = ($tvshows->tvdata->where('simokey', 'backdrop_img')->first()->simovalue)??null;
  $value->rating = ($tvshows->tvdata->where('simokey', 'rating')->first()->simovalue)??null;
  $value->popular = ($tvshows->tvdata->where('simokey', 'popular')->first()->simovalue)??null;
  $value->tv_status = ($tvshows->tvdata->where('simokey', 'status')->first()->simovalue)??null;
  $value->save();
}


    }

    // $tvshows_Meta = $tvshows_Meta->first();
    // if (isset($value->name) &&  $key == 14) {
    //   $name = $this->SlugToName($value->name) ;
    //   $tvshows = (new New_Tvshows)
    //                    ->Where('title', 'like' , '%'. $name.'%')
    //                    ->orWhere('title_arabic', 'like' , '%'. $name.'%')
    //                    ->orWhere('title_org', 'like' , '%'. $name.'%')
    //                    ->orWhere('title_old', 'like' , '%'. $name.'%');
    // dd($links);
    // }

//   $data[] = [ "name1" => $name,"name2" => $this->SlugToName($value->name,$value->season_nm,"name")];
    }
//dd($data);

return back();




    //$user = Seasons::paginate(24);
  //  $user = $link->seasons;
  //  return view('admincp.fixbrowse.tvshows',['data' => $user]);
  }
}
