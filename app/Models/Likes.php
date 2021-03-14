<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Likes extends Model
{
       use SoftDeletes;
       protected $table = 'liks';
       protected $fillable = ['deleted_at','parent_id','title', 'type', 'type_id', 'liks', 'user_id',];

       public function liks()
        {
            return $this->hasMany('App\Models\Liks','parent_id');
        }
        public function notify()
         {
             return $this->hasMany('App\Models\Likes','type_id','type_id');
         }



        public function User()
         {
           return $this->belongsTo('App\Models\user');

         }
         public function favorit_movies()
          {
              return $this->belongsTo('App\Models\New_Movies','type_id');
          }
          public function favorit_tvshows()
           {
               return $this->belongsTo('App\Models\New_Tvshows','type_id');
           }
          public function moviesdata()
           {
               return $this->hasOne('App\Models\New_Movies','id','type_id');
           }
           public function tvshowsdata()
            {
                return $this->hasOne('App\Models\New_Tvshows','id','type_id');
            }
          public function Episodes()
           {
               return $this->belongsTo('App\Models\Episodes','type_id','id');
           }
}
