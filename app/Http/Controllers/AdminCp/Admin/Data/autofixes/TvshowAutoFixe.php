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

class TvshowAutoFixe extends Controller
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
  public function SlugToName($name1)
  {
    $names = str_ireplace(" Siend", "", $name1) ;
    $name = explode("-", $names);
    $name = array_filter($name);
    if (isset($name[2])) {
    $names = $name[0].'-'.$name[1].'-'.$name[2] ;
    }
    else if (isset($name[1])) {
    $names = $name[0].'-'.$name[1] ;
    }
    else {
      $names = $name[0] ;

    }

    return trim(preg_replace('/[^\p{P} a-z0-9]/ui', '', $names)) ;
  }
  public function index($id)
  {




    //$user = Seasons::paginate(24);
  //  $user = $link->seasons;
  //  return view('admincp.fixbrowse.tvshows',['data' => $user]);
  }

  public function seasons(Request $request,$tv)
  {
  //  MyFunction::authorizes(['AdmincpSuper', 'Admincp']);



  $DbMovies= New_Tvshows::find($tv) ;
  $apidata = new SimoPhp;
  $movie = $apidata->ApiOneAuto($DbMovies->tmdb_id,"season",$request->sea_id??$request->ids) ;
  $Seasons = new Seasons;
  $chek= $Seasons
         ->where('tv_id', $DbMovies->id)
         ->where('season_nm', $request->sea_id??$request->ids)
         ->where('tmdb_id', $DbMovies->tmdb_id)
         ->first() ;


         if (isset($chek)) {
          $Seasons = $chek ;
         }

        if (!$chek) {
          $Seasons->tv_id = $DbMovies->id;
          $Seasons->tmdb_id = $DbMovies->tmdb_id;
          $Seasons->slug = Str::slug($Seasons->name , "-");
          $Seasons->folder_date  = $movie['Date_folder'] ;
          $Seasons->tvshow_slug = $DbMovies->slug ;
          $Seasons->tvshow_img = $DbMovies->tvdata->where('simokey', 'postimg')->first()->simovalue;

     // end save info movies meta
        }
        if (!isset($chek->post_img)) {
          $Seasons->post_img = $movie["postimg"] ;
        }
        $Seasons->name = $DbMovies->title_org.' '.$movie['title'];
        $Seasons->overview = $movie['overview'];
        $Seasons->name_season = $movie['title'];
        $Seasons->name_tvshow = $DbMovies->title_org;
        $Seasons->season_nm = $movie["season_nm"] ;
        $Seasons->episode_nm = $movie["episode_nm"] ;
        $Seasons->first_date = $movie["first_date"];
        Auth()->user()->UserSeasons()->save($Seasons);
       // end check

     if (isset($request->ids) && $Seasons->tmdb_id??$chek->tmdb_id) {
       $season_nm = $Seasons->season_nm??$chek->season_nm ;
       return $season_nm ;
     }
     if (isset($request->sea_id) && $Seasons->tmdb_id??$chek->tmdb_id) {
        $id = $Seasons->id??$chek->id ;
       return redirect('seasons/edit/'.$id)->with('status', 'Profile updated!');
     }
  }

  public function update(Request $request)
  {

        $value = New_Tvshows::find($request->id);
        if (!isset($value->id)) {
          return back();
        }
        $title = $this->SlugToName(Str::slug($value->title, '-'));
        $title_arabic = $this->SlugToName(Str::slug($value->title_arabic, '-'));
        $title_org = $this->SlugToName(Str::slug($value->title_org, '-'));
        $title_old = $this->SlugToName(Str::slug($value->title_old, '-'));

        $New_Tvshows_Meta = new New_Tvshows_Meta;
        if (isset($value->title)) {
          $tvshows_Meta = $New_Tvshows_Meta
                          ->Where('simokey','title')
                          ->Where('simovalue', 'like' , '%'.$title.'%')
                          ->get();
          if (count($tvshows_Meta) == 0) {
            $tvshows_Meta = $New_Tvshows_Meta
                          ->Where('simokey','title_arabic')
                          ->Where('simovalue', 'like' , '%'.$title_arabic.'%')
                          ->get();
          }
          if (count($tvshows_Meta) == 0) {
            $tvshows_Meta = $New_Tvshows_Meta
                          ->Where('simokey','title_org')
                          ->Where('simovalue', 'like' , '%'. $title_org.'%')
                          ->get();
          }
          if (count($tvshows_Meta) == 0) {
            $tvshows_Meta = $New_Tvshows_Meta
                          ->Where('simokey','title_old')
                          ->Where('simovalue', 'like' , '%'.$title_old.'%')
                          ->get();
          }

          if (count($tvshows_Meta) <= 1) {
            return back() ;
          }
          dd($tvshows_Meta);
        foreach ($link->all() as $key => $value) {

          $tvshows = new New_Tvshows;
        //  dd($tvshows_Meta,$name,$this->SlugToName($value->name,$value->season_nm,"name"),$value);
      if (!isset($tvshows_Meta->tv_id)) {
      $tvshows->user_id = $value->user_id ;
      $tvshows->title = $this->SlugToName($value->name,null,"name") ;
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





  }

}
