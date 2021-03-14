<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class New_Movies extends Model
{
  use SoftDeletes;
       protected $table = 'movies';
       protected $fillable = [

  'deleted_at','tv_id',  'title', 'type', 'content',
       ];

       public function category()
        {

     return $this->hasMany('App\Models\categorys','type_id');
         }
       public function like()
        {

            return $this->hasMany('App\Models\Likes','type_id');
        }
       public function comment()
        {

            return $this->hasMany('App\Models\Comments','type_id');
        }
       public function server()
        {

            return $this->hasMany('App\Models\Servers','type_id');
        }
       public function tvdata()
        {
            return $this->hasMany('App\Models\New_Movies_meta','tv_id');
        }
        public function tv()
         {

             return $this->belongsTo('App\Models\New_Movies_meta','id');
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

}
