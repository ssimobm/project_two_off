<?php

namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Options;

use App\MyClass\MyFunction;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('admin');
         // MyFunction::authorizes(['AdmincpSuper','Admincp','Editor']);



         //  $this->authorize("watch_now", auth()->user());

     }

    public function index()
    {
   MyFunction::authorizes(['AdmincpSuper','Admincp']);


$Options= Options::get() ;
$tiles= MyFunction::seo_title('App\Models\Options','Setting_NameSite','');

        return view("admincp.Options.settings",["Options"=> $Options,"tiles"=> $tiles]) ;
    }



    public function update(Request $request)
    {

MyFunction::authorizes(['AdmincpSuper','Admincp']);

$NameSite_active = Options::where('option_name', 'Setting_SiteActive')->first();
if (isset($NameSite_active)) {
  $NameSite_active->option_value = "check_".$request->site_check ;
  $NameSite_active->save();
}else{
  $NameSite_active = new Options;
  $NameSite_active->option_name = 'Setting_SiteActive' ;
  $NameSite_active->option_value = "check_".$request->site_check ;
  $NameSite_active->save();
}


$NameSite = Options::where('option_name', 'Setting_NameSite')->first();
if (isset($NameSite)) {
  $NameSite->option_value = $request->site_name ;
  $NameSite->save();
}else{
  $NameSite = new Options;
  $NameSite->option_name = 'Setting_NameSite' ;
  $NameSite->option_value = $request->site_name ;
  $NameSite->save();
}

$DescSite = Options::where('option_name', 'Setting_DescSite')->first();
if (isset($DescSite)) {
  $DescSite->option_value = $request->site_desc ;
  $DescSite->save();
}else{
  $DescSite = new Options;
  $DescSite->option_name = 'Setting_DescSite' ;
  $DescSite->option_value = $request->site_desc ;
  $DescSite->save();
}

$explode = MyFunction::ary_filter_json($request->site_key);
$SiteKey = Options::where('option_name', 'Setting_SiteKey')->first();
if (isset($SiteKey)) {
$SiteKey->option_value = $explode ;
$SiteKey->save();
}else{
$SiteKey = new Options;
$SiteKey->option_name = 'Setting_SiteKey' ;
$SiteKey->option_value = $explode ;
$SiteKey->save();
}

return back();


    }
}
