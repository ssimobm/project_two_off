<?php

namespace App\Http\Controllers\AdminCp\Admin\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\Options;


class Searchcontroller extends Controller
{
    public function ajaxSearch(Request $request)
    {
if (strlen($request->search)>2) {
  if ($request->types == "All") {
    $Search = Tvshows::where('title', 'LIKE', '%'.$request->search.'%')->get();
  }else {
  $Search = Tvshows::where('type', $request->types)->where('title', 'LIKE', '%'.$request->search.'%')->get();
  }


  return view("Search.indexajax",["Search" => $Search,]) ;
}else {
    return '<div class="dropdown-header noti-title">
    <h5 class="text-overflow mb-2">Found 0 results</h5>
    </div>' ;
}


    }
}
