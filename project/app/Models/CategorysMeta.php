<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategorysMeta extends Model
{
  use SoftDeletes;

  protected $table = 'cate_meta';
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

  protected $fillable = ['deleted_at','parent_id','name', 'type','taxonomy', 'slug',];

  public function movies()
   {
       return $this->hasMany('App\Models\Movies','id');
   }
   public function tvmovies()
    {
        return $this->belongsTo('App\Models\Movies','type_id');
    }
   public function Categorys()
    {
        return $this->belongsTo('App\Models\Categorys','cate_id');
    }

    public function Tags()
     {
         return $this->belongsTo('App\Models\Categorys','cate_id');
     }
}
