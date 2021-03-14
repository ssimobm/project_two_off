<?php

namespace App\MyClass;

class MyClass2 {

public $DB ;
public $Value ;

public function Simo_Op($key,$v)
{
$DB = $this->DB;
$NameValue = $this->Value;

   $simo = $DB::Where($key, $v)->firstOrFail()->$NameValue ;
   return $simo ;
}

  public function file_get_contents_curl($url) {
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_ENCODING, 0);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "GET");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
      ""
    ));
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
  }
  public static function go($id,$key,$lang) {

$MyClass2 = new MyClass2 ;

    $url1 = 'https://api.themoviedb.org/3/tv/popular?api_key='.$key.'&language='.$lang.'&page='.$id.'';

    $html = $MyClass2->file_get_contents_curl($url1);


    return $html ;


      }
}
