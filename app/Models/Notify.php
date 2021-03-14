<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{

  protected $table = 'notify';
  protected $datas;

  function __construct($Data=null)
  {
  $this->datas = $Data ?: null;

  }

  public function data($get)
  {
  return $this->datas->only($get)->first() ;
  }

  public function Episodes()
   {
   return $this->hasMany('App\Models\Episodes','type_id','id');
   }

    // Show all count Notifications
    public function Count()
    {
      $user = $this->data('Users') ;
     return $this->where('user_id', $user->id)
                 ->where('taxonomy', "Notify")
                 ->where('read', "0")
                 ->count() ;
    }

    // Show is Read Notifications
    public function ShowRead()
    {
      $user = $this->data('Users') ;
      return $this->where('user_id', $user->id)
                  ->where('taxonomy', "Notify")
                  ->where('read', "read")
                  ->get() ;
    }

    // Show No Read Notifications
    public function ShowNoRead()
    {
      $user = $this->data('Users') ;
      return $this->where('user_id', $user->id)
                  ->where('taxonomy', "Notify")
                  ->where('read', "0")
                  ->get() ;
    }

    // Show All my user Notifications
    public function ShowAll()
    {
      $user = $this->data('Users') ;
      return $this->where('user_id', $user->id)
                  ->where('taxonomy', "Notify")
                  ->get() ;
    }
    // // Create new Notifications
    // public function CreateEp()
    //
    // {dd($this->data('Posts'));
    //   $post = $this->data('Posts') ;
    //   $user = $this->data('Users') ;
    //   $data = $this->where('type_id', $user->id)
    //                ->where('user_id', $post->id)
    //                ->where('type', 'Tvshow');
    //
    //
    //   foreach ($data->get()->all() as $key => $value) {
    //     $simo[] = $value->type_id;
    //
    //   }
    //  return $simo ;
    // }
    // Create new Notifications
    public function CreateEp()

    { // Info Data Ep And User
      $Ep    = $this->data('Posts') ;
      $tv    = ($this->data('Posts'))->tv ;
      $user  = $this->data('Users') ;
      $users = $this->firstOrFail()
                    ->where('type_id',isset($tv->id) ? $tv->id : null)
                    ->where('taxonomy', 'Follow');

foreach ($users->get()->all() as $key => $value) {
$chek = $Ep->Notifysave()->where('user_id', $value->user_id)->where('type_id', $Ep->id)->first() ;
// Add New Notify Ep
if (! $chek) {
    $values = new Notify ;
    $values->user_id = $value->user_id;
    $values->type = 'Episodes';
    $values->taxonomy = 'Notify';
    $values->type_id = $Ep->id;
    $values->read = '0';
    $values->save();
}}
}

      //  $value->user_id = $value->user_id;
      //  $value->type = 'Notify';
      //  $value->type_id = $Ep->id;
      //  $value->read = '0';
    //    $Ep->Notifysave()->save($value);



  //   public static function testsimo($notify , $ids)
  //   {
  //
  // $count = $notify->UserAll->where('read', 0)->count() ;
  //
  //
  //     return $count ;
  //   }


}
