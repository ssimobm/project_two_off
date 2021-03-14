<?php

namespace App\Policies;

use App\Season;
use App\Seasons;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeasonsPolicy
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
     * @param  \App\Seasons  $Seasons
     * @return mixed
     */
    public function view(User $user, Seasons $Seasons)
    {
        return true ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0 ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $Seasons
     * @return mixed
     */
    public function update(User $user, Seasons $Seasons)
    {
        return $user->id == $Seasons->user_id ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $Seasons
     * @return mixed
     */
    public function delete(User $user, Seasons $Seasons)
    {
        return $user->id == $Seasons->user_id ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $Seasons
     * @return mixed
     */
    public function restore(User $user, Seasons $Seasons)
    {
        return $user->id == $Seasons->user_id ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Seasons  $Seasons
     * @return mixed
     */
    public function forceDelete(User $user, Seasons $Seasons)
    {
        return $user->id == $Seasons->user_id ;
    }
}
