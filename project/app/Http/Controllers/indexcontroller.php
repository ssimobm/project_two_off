<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Episodes;
use App\Models\New_Movies;
use App\Models\New_Tvshows;
use Validator;
use Auth;
use App\Models\Seasons;
use Illuminate\Http\Request;
use App\MyClass\MyClass2;
use Illuminate\Support\Str;


class indexcontroller extends Controller
{


  public function __construct()
  {
$this->middleware('siteonline');


   //$this->middleware('admin');
   //$this->middleware('editor');
    //  $this->middleware('throttle:3,1');
  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


//$Episodes = Episodes::get()->sortByDesc('First_Date')->skip(0)->take(12);
$Episodes = Episodes::get()->sortByDesc('first_date')->skip(0)->take(12);

$New_Movies = New_Movies::get()->sortByDesc('First_Date')->skip(0)->take(12);
//$New_Tvshows = New_Tvshows::get()->sortByDesc('First_Date')->skip(0)->take(12);
$New_Tvshows = Seasons::get()->sortByDesc('First_Date')->skip(0)->take(12);
//dd($New_Movies->first()->tvdata->where('simokey', 'Movie_Postimg')->first()->simovalue);
      return  view('sites.index' ,[ 'Episodes' => $Episodes,'Movies' => $New_Movies, 'Tvshows' => $New_Tvshows, ]);
    }


}
