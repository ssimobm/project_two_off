<?php

namespace App\Policies;

use App\Models\Season;
use App\Models\Seasons;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesAuthPolicy
{
  use HandlesAuthorization;
// public function before($user , $data)
// {
//   if ($user->AdminUser() == true and $data == 'delete' ) {
//     return true ;
//   }
// }

  public function AdmincpSuper(User $user)
  {
    return $user->id == '1' ;
  }

  public function Admincp(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    return $json->admin == 'yes' ;
    }

  public function Moderator(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    return $json->Moderator == 'yes' ;
  }


  public function Editor(User $user)
  {

    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    return $json->editor == 'yes' ;

  }

  public function Editor_Movies(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    return $json->editor_movies == 'yes' ;
  }

  public function Editor_Tv(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->editor_tv == 'yes') {
    return true ;
    }
  }


  public function Editor_Ep(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->editor_ep == 'yes') {
    return true ;
    }
  }


  public function Editor_Sea(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->editor_sea == 'yes') {
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

  public function Users(User $user)
  {
    $json = $user->UserMeta->UserRole->type ;
    if (isset($json)) {
    if ($json == 'role_user') {
    return true ;
    }
    }
    // if (isset($user)) {
    // return true ;
    // }
  }
  public function GuestGet(User $user)
  {
    if (! isset($user->id)) {
    return true ;
    }
      return true ;
    }


  public function bann(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->bann == 'yes') {
    return true ;
    }
  }

  public function Create(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->create == 'yes') {
    return true ;
    }
  }

  public function Edit(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->edit == 'yes') {
    return true ;
    }
  }

  public function Delet(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->delete == 'yes') {
    return true ;
    }
  }
  public function view(User $user)
  {
       if ($user) {
         return true ;
       }

  }
  public function Views(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->view == 'yes') {
    return true ;
    }
  }

  public function Watch_later(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->watch_later == 'yes') {
    return true ;
    }
  }

  public function Favorit(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->favoris == 'yes') {
    return true ;
    }
  }

  public function Watch_Now(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->watch_now == 'yes') {
    return true ;
    }
  }

  public function Notification(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->notification == 'yes') {
    return true ;
    }
  }

  public function Comments(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->comment == 'yes') {
    return true ;
    }
  }
  public function Likes(User $user)
  {
    $json = json_decode($user->UserMeta->UserRole->type_value) ;
    if ($json->likes == 'yes') {
    return true ;
    }
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
