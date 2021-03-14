<?php

namespace App\Policies;

use App\Season;
use App\Seasons;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class oldRolesAuthPolicy
{
  use HandlesAuthorization;


  public function AdmincpSuper(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_admin' ;
  }

  public function Admincp(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_admin_mini' ;
  }

  public function Moderator(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_moderator' ;
  }


  public function Editor(User $user)
  {
  return $user->UserMeta->UserRole->type === 'role_editor' ;

  }

  public function Editor_Movies(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_Editor_Movies' ;
  }

  public function Editor_Tv(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_Editor_Tv' ;
  }


  public function Editor_Ep(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_role_Ep' ;
  }


  public function Editor_Sea(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_role_Sea' ;
  }


  public function User(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_User' ;
  }

  public function bann(User $user)
  {
    return $user->UserMeta->UserRole->type === 'role_bann' ;
  }


  // public function viewAny(User $user)
  // {
  //   //
  // }
  //
  //
  // public function viewAny(User $user)
  // {
  //   //
  // }
  //
  //
  // public function viewAny(User $user)
  // {
  //   //
  // }

}
