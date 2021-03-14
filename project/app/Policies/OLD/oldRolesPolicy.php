<?php

namespace App\Policies;

use App\Season;
use App\Seasons;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OLDRolesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true ;
    }
    public function comment(User $user)
    {
      $json = json_decode($user->UserMeta->UserRole->type_value) ;
      if ($json->comment == 'yes') {
      return true ;
      }
      }
      public function likes(User $user)
      {
        $json = json_decode($user->UserMeta->UserRole->type_value) ;
        if ($json->likes == 'yes') {
        return true ;
        }
        }
        public function favoris(User $user)
        {
          $json = json_decode($user->UserMeta->UserRole->type_value) ;
          if ($json->favoris == 'yes') {
          return true ;
          }
          }
          public function watch_later(User $user)
          {
            $json = json_decode($user->UserMeta->UserRole->type_value) ;
            if ($json->watch_later == 'yes') {
            return true ;
            }
            }
            public function watch_now(User $user)
            {
              $json = json_decode($user->UserMeta->UserRole->type_value) ;
              if ($json->watch_now == 'yes') {
              return true ;
              }
              }
              public function api(User $user)
              {
                $json = json_decode($user->UserMeta->UserRole->type_value) ;
                if ($json->api == 'yes') {
                return true ;
                }
                }

            /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
     public function editor(User $user)
     {

       $json = json_decode($user->UserMeta->UserRole->type_value) ;

       if ($json->editor == 'yes') {
       return true ;
       }


       }

       public function editor_tv(User $user)
       {

   if (isset($user->UserMeta->UserRole)) {
     $json = json_decode($user->UserMeta->UserRole->type_value) ;
     if ($json->editor_tv == 'yes' or $user->id == 1) {
     return true ;
     }
   }
   return false ;
       }
       public function editor_ep(User $user)
       {

      if (isset($user->UserMeta->UserRole)) {
      $json = json_decode($user->UserMeta->UserRole->type_value) ;
      if ($json->editor_ep == 'yes' or $user->id == 1) {
      return true ;
      }
      }
      return false ;
       }
       public function editor_movies(User $user)
       {

      if (isset($user->UserMeta->UserRole)) {
      $json = json_decode($user->UserMeta->UserRole->type_value) ;
      if ($json->editor_movies == 'yes' or $user->id == 1) {
      return true ;
      }
      }
      return false ;
       }

  ////////////////////////////////
     public function guest(User $user)
     {

   return false ;
       }
     //auth checked admin
     public function user(User $user)
     {

 if ($user->UserMeta->UserRole->type == 'role_user') {
 return true ;
 }
 return false ;

     }
         public function admin(User $user)
         {


     // if ($user->UserMeta->UserRole->type == 'role_admin') {
     // return true ;
     // }
     // return false ;

     if (isset($user->UserMeta->UserRole)) {
       $json = json_decode($user->UserMeta->UserRole->type_value) ;

       if ($json->admin == 'yes' or $user->id == 1) {
       return true ;
       }
     }
     return false ;
         }
//auth checked admin
//     public function admin(User $user)
//     {
//

//
//     }
    public function create(User $user)
    {
// if ($user->UserMeta->UserRole->type === "role_admin" or ) {
//     return true ;
// }

$simo = $user->UserMeta->UserRole->type_value ;

if ($simo) {
  $json = json_decode($simo) ;
  if ($json->create == 'yes') {
  return true ;
  }
}

return false ;
// if ($user->AdminUser() == 'role_user' or $user->AdminUser() == 'role_admin' ) {
//  return true ;
// }
// return false ;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $user
     * @return mixed
     */
    public function update(User $user)
    {
      $json = json_decode($user->UserMeta->UserRole->type_value) ;

      if ($json->admin == 'yes' or $user->id == 17) {
      return true ;
      }

  //return $user->AdminUser() === "role_admin";
      //  return $user->id == $user->user_id ;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->id == $user->user_id ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->id == $user->user_id ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->id == $user->user_id ;
    }
}
