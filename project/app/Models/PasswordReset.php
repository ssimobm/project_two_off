<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{

  protected $table = 'password_resets';
  protected $primaryKey = 'email';

public function UserRole()
     {
         return $this->belongsTo('App\Models\Roles','simovalue');
     }


}
