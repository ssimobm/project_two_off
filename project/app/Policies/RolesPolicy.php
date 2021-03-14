<?php

namespace App\Policies;

use App\Season;
use App\Seasons;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesPolicy
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

    public function create(User $user)
    {

    }

}
