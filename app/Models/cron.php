<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class cron extends Model
{

       protected $table = 'cron';
       protected $fillable = [ 'name',
       ];
       public $timestamps = false;


       public function testmeta()
        {
          $this->id = $this->tmdb_id ;
            return $this->hasMany('App\Models\TVMeta','simovalue');
        }


  public function sea_meta()
   {
       return $this->hasMany('App\Models\TVMeta','tv_id');
   }


           public function tv()
            {
                return $this->belongsTo('App\Models\TVMeta','tv_id');
            }
}
