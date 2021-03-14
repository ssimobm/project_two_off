<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class categorys extends Model
{
  use SoftDeletes;

  protected $table = 'categorys';
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

  protected $fillable = ['deleted_at','parent_id','name', 'type','taxonomy', 'slug',];

  public function cate_meta()
   {
       return $this->hasMany('App\Models\CategorysMeta','cate_id');
   }
   public function catemeta()
    {
        return $this->hasOne('App\Models\CategorysMeta','cate_id');
    }
}
