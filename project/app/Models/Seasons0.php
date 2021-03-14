<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seasons extends Model
{
  use SoftDeletes;
       protected $table = 'seasons';
       protected $fillable = [

  'tv_id',  'user_id	', 'Name', 'Overview','deleted_at','slug'
       ];


       public function episode()
            {
                return $this->hasMany('App\Models\Episodes','sea_id');
            }

           public function tv()
            {
                return $this->belongsTo('App\Models\TVMeta','tv_id');
            }

            public function tvshow()
             {
                 return $this->belongsTo('App\Models\Tvshows','id');
             }
}
