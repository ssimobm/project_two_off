<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
  use SoftDeletes;
       protected $table = 'comments';
       protected $dates = ['created_at', 'updated_at', 'deleted_at'];

       protected $fillable = ['deleted_at','parent_id','title', 'type', 'type_id', 'comments', 'user_id',];

       public function comment()
        {
            return $this->hasMany('App\Models\comments','parent_id');
        }

        public function user()
         {
             return $this->belongsTo('App\Models\User','user_id');
         }

         public function like()
          {

              return $this->hasMany('App\Models\Likes','type_id');
          }

}
