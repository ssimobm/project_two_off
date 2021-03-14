<?php

namespace App\Policies;

use App\Likes;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;
    public function before($user , $data)
    {
      if ($user->AdminUser()) {
        return true ;
      }
    }

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
     * @param  \App\Likes  $likes
     * @return mixed
     */
    public function view(User $user)
    {
         if ($user) {
           return true ;
         }

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      if ($user) {
        return true ;
      }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Likes  $likes
     * @return mixed
     */
    public function update(User $user, Likes $likes)
    {
          return $user->id == $likes->user_id  ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Likes  $likes
     * @return mixed
     */
    public function deletes(User $user, Likes $likes)
    {

        return $user->id == $likes->user_id  ;

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Likes  $likes
     * @return mixed
     */
    public function restore(User $user, Likes $likes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Likes  $likes
     * @return mixed
     */
    public function forceDelete(User $user, Likes $likes)
    {
        //
    }
}
