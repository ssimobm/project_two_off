<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TV extends Model
{
     protected $table = 'tv';

     public function cat()
      {
          return $this->hasMany('App\Models\TV','parent_id');
      }


              public function tv()
               {
                   return $this->belongsTo('App\Models\TVMeta','tv_id');
               }

     public function tvdata()
      {
          return $this->hasMany('App\Models\TVMeta','tv_id');
      }




      public function seasons()
       {
           return $this->hasMany('App\Models\Seasons','tv_id');
       }






       public function tvmeta()
        {
            return $this->hasMany('App\Models\TVMeta','tv_id');
        }
        public function server()
         {
             return $this->hasMany('App\Models\Servers','type_id');
         }

}
