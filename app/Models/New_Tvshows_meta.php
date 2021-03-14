<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class New_Tvshows_meta extends Model
{
  use SoftDeletes;

  protected $table = 'tvshows_meta';
  protected $fillable = [
    'simokey', 'simovalue','deleted_at','tv_id',
  ];

    public function tvmeta2()
     {
$this->id=$this->tv_id;

         return $this->belongsTo('App\Models\New_tvshows','id');
     }



  public function tvmeta()
   {
       return $this->hasMany('App\Models\New_tvshows','tv_id');
   }







  public function tv()
   {
       return $this->belongsTo('App\Models\TV');
   }
   public function season()
    {
      $this->id=$this->simovalue;
        return $this->belongsTo('App\Models\TV','id');
    }

    public function episode()
     {
       $this->id=$this->simovalue;
         return $this->hasMany('App\Models\TV','id');
     }

}
