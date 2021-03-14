<?php

namespace App\Http\Controllers\AdminCp\Admin;
use App\Http\Controllers\Controller;
use App\Models\Visitor ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MyClass\MyFunction;
class StatisticController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('auth');
      $this->middleware('admin');
      $this->middleware('siteonline');
      $this->middleware('views')->only('index');
      $this->middleware('create')->only('create', 'store');
      $this->middleware('edit')->only('edit', 'update');
      $this->middleware('delete')->only('delete');
      //$this->middleware('admin')->only('restore', 'destroy', 'showdalet', 'alldestroy');

  }
    public function Today()
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $now = Carbon::now();


      //$MonthStatistic = Visitor::where('created_at', "like" , "%".($now->year."-".sprintf("%02d", $now->month))."%") ;
      $MonthStatistic = Visitor::where('created_at', ">=" ,$now->today()->subDays(30)) ;
      $monty = [] ;
      foreach ($MonthStatistic->get() as $key => $value) {
        $date_db = $value->created_at->format('Y-m-d') ;
        if (!in_array($date_db, $monty)) {
        $monty[$date_db] =   ["x"=>$date_db,"y"=> Visitor::where('created_at', "like" , "%".($date_db)."%")->count()] ;

        }
      }
      asort($monty);
      $WeekStatistic = Visitor::where('created_at', ">=" ,$now->today()->subDays(7)) ;
      $Week = [] ;
      foreach ($WeekStatistic->get() as $key => $value) {
        $date_db = $value->created_at->format('Y-m-d') ;
        if (!in_array($date_db, $monty)) {
        $Week[$date_db] =   ["x"=>$date_db,"y"=> Visitor::where('created_at', "like" , "%".($date_db)."%")->count()] ;

        }
      }
      asort($Week);
      $episodes = Visitor::where('created_at', "like" , "%".($now->toDateString())."%")->where('type', 'episodes')->count() ;
      $tvshows = Visitor::where('created_at', "like" , "%".($now->toDateString())."%")->where('type', 'tvshows')->count() ;
      $movies = Visitor::where('created_at', "like" , "%".($now->toDateString())."%")->where('type', 'movies')->count() ;
      return view("admincp.statistic.Today",["episodes" => $episodes,"movies" => $movies,"tvshows" => $tvshows,"week" => json_encode(array_values($Week)),"monty" => json_encode(array_values($monty)),"week_count" => $WeekStatistic->count(),"monty_count" => $MonthStatistic->count()]) ;
    //  dd($MonthStatistic->count(),$TodayStatistic->count());
    }
}
