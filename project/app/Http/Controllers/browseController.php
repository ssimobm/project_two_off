<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Episodes;
use App\Models\Seasons;
use App\Models\New_Tvshows;
use App\Models\New_Movies;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class browseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function episodes()
    {

//  $user = New_Tvshows::where('type', 'Tvshows')->whereDate('created_at', Carbon::now()->subHour())->paginate(20);
$user = Episodes::paginate(20);
return view('browse.episodes',['data' => $user]);

    }
    public function tvshows()
    {
//  $user = New_Tvshows::where('type', 'Tvshows')->whereDate('created_at', Carbon::now()->subHour())->paginate(20);
//$user = New_Tvshows::paginate(24);
$user = Seasons::paginate(24);
return view('browse.tvshows',['data' => $user]);
    }
    public function movies()
    {
//  $user = New_Tvshows::where('type', 'Tvshows')->whereDate('created_at', Carbon::now()->subHour())->paginate(20);
$user = New_Movies::paginate(24);
return view('browse.movies',['data' => $user]);
    }
}
