<?php

namespace App\MyClass;

class MyFunction {

public $Name ;
public $Value ;

public static function authorizes($data )
{
  if (\Gate::none($data, auth()->user())) {
    return abort(403, 'Unauthorized action.');

  }
}
public static function permission($data , $model)
{
  if (\Gate::none($data, $model)) {
    return abort(403, 'Unauthorized action.');

  }
}

public static function ary_filter_json($key)
{
$explode = str_replace(",", " ", $key);
$explode = array_filter(explode(" ",$explode)) ;
$explode_json = json_encode($explode) ;
return $explode_json ;
}
public static function ary_filter_decjson($key)
{
$explode = array_filter(json_decode($key)) ;
$explode_json = implode(" ",$explode) ;
return $explode_json ;
}
public static function seo_title($v,$k,$d)
{


  if (isset($v::where('option_name', $k)->first()->option_value)) {
    $id = $v::where('option_name', $k)->first()->option_value ;
    $explode = str_replace("{id}", $d, $id);
    return $explode ;
  }

}
}
