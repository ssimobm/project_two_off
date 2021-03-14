<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Season extends Model
{
  use SoftDeletes;
       protected $table = 'tv';
       protected $fillable = [

  'deleted_at','tv_id',  'title', 'type', 'content',
       ];


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
