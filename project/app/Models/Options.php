<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
     protected $table = 'options';
     protected $primaryKey = 'option_id';
     protected $fillable = [
      'option_name', 'option_value',
     ];
public $timestamps = false;








       public function tvmeta()
        {
            return $this->hasMany('App\Models\TVMeta','tv_id');
        }

}
