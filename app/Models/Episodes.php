<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Episodes extends Model
{
  use SoftDeletes;
       protected $table = 'episodes';
       protected $fillable = [

  'sea_id', 'tv_id',  'user_id	', 'Name', 'Overview',
       ];
       public function notify()
        {
            return $this->hasMany('App\Models\Likes','type_id','tv_id');
        }
        public function seasons()
         {
             return $this->belongsTo('App\Models\Seasons','sea_id','id');
         }
       public function server()
        {

            return $this->hasMany('App\Models\Servers','type_id');
        }

        public function comment()
         {

             return $this->hasMany('App\Models\Comments','type_id');
         }
        public function tv()
         {

             return $this->belongsTo('App\Models\New_Tvshows');
         }
         public function like()
          {

              return $this->hasMany('App\Models\Likes','type_id');
          }
          public function Tags()
           {

               return $this->hasMany('App\Models\CategorysMeta','type_id');
           }

}
