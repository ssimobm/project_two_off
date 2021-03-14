<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function UserMovies()
   {
     return $this->hasOne('App\Models\New_Movies','user_id');

   }
   public function UserSeasons()
  {
    return $this->hasOne('App\Models\Seasons','user_id');

  }
  public function UserEpisodes()
 {
   return $this->hasOne('App\Models\Episodes','user_id');

 }
   public function UserTvshows()
  {
    return $this->hasOne('App\Models\New_Tvshows','user_id');

  }
 //  public function UserEpisodes()
 // {
 //
 //   return $this->hasOne('App\Models\Episodes','user_id','id');
 //
 // }
   public function UserLike()
    {
      return $this->hasMany('App\Models\Likes','user_id');

    }
    public function comments()
     {
       return $this->hasMany('App\Models\Comments','user_id');

     }

    public function UserFavorit()
     {
       return $this->hasMany('App\Models\Likes','user_id');

     }

    public function UserMeta()
         {
             return $this->hasOne('App\Models\UserMeta','user_id');
         }

   public function AdminUser()
              {

                return $this->UserMeta->UserRole->type == 'role_adminsuper' ;

              }

              public function verifyUser()
                 {
                     return $this->hasOne('App\Models\VerifyUser');
                 }

  public function resetpassword()
  {
    return $this->belongsTo('App\Models\PasswordReset','email');
  }


}
