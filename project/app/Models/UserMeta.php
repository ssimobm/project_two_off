<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMeta extends Model
{
  use SoftDeletes;

  protected $table = 'user_meta';
   protected $fillable = [
 'simokey','simovalue',
   ];

public function UserRole()
     {
         return $this->belongsTo('App\Models\Roles','simovalue');
     }


}
