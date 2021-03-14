<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servers extends Model
{
  use SoftDeletes;

     protected $table = 'servers';

  public function seasons()
       {
           return $this->hasMany('App\Models\Seasons','tv_id');
       }
 public function tvmeta()
        {
            return $this->hasMany('App\Models\TVMeta','tv_id');
        }

}
