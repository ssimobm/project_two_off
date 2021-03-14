<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tvshows extends Model
{
  use SoftDeletes;
       protected $table = 'tv';
       protected $fillable = [

  'deleted_at','tv_id',  'title', 'type', 'content',
       ];
       public function category()
        {

     return $this->hasMany('App\Models\categorys','type_id');
         }
       public function comment()
        {

            return $this->hasMany('App\Models\Comments','type_id');
        }
public function Seasons()
 {
     return $this->hasMany('App\Models\Seasons','tv_id');
 }
       public function tvdata()
        {
            return $this->hasMany('App\Models\TVMeta','tv_id');
        }
        public function tv()
         {

             return $this->belongsTo('App\Models\TVMeta','id');
         }
         public function cat()
          {
              return $this->hasMany('App\Models\TV','parent_id');
          }
         public function usersD()
          {

              return $this->belongsTo('App\Models\User','id');
          }
          public function Tags()
           {

               return $this->hasMany('App\Models\CategorysMeta','type_id');
           }
           public function tvnotify()
            {

                return $this->hasMany('App\Models\Likes','type_id');
            }
}
