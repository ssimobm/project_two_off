<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New_Tvshows;
use App\Models\New_Movies;
use App\Models\New_TVMeta;
use App\Models\Options;
use Illuminate\Support\Facades\DB;

class Searchcontroller extends Controller
{
    public function ajaxSearch(Request $request)
    {
if (strlen($request->search)>2) {

  if ($request->types == "All") {
    $Search = DB::table('movies')->where('title', 'LIKE', '%'.$request->search.'%')
                          ->orWhere('title_org', 'LIKE', '%'.$request->search.'%')
                          ->get();

   if (!count($Search)) {
     $Search = DB::table('tvshows')->where('title', 'LIKE', '%'.$request->search.'%')
                           ->orWhere('title_org', 'LIKE', '%'.$request->search.'%')
                           ->get();
   }
    // match all of the values


  }


  if ($request->types == "Movies") {
    $Search = New_Movies::where('title', 'LIKE', '%'.$request->search.'%')
                          ->orWhere('title_org', 'LIKE', '%'.$request->search.'%')
                          ->get();

  }
  if ($request->types == "Tvshows") {
      $Search = New_Tvshows::where('title', 'LIKE', '%'.$request->search.'%')
                              ->orWhere('title_org', 'LIKE', '%'.$request->search.'%')
                              ->get();

  }


  return view("sites.Search.indexajax",["Search" => $Search,]) ;
}else {
    return '<div class="dropdown-header noti-title">
    <h5 class="text-overflow mb-2">Found 0 results</h5>
    </div>' ;
}


    }
}
