<?php

namespace App\Http\Middleware\Roles;

use Closure;

class superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      if (! $request->user()) {
      return redirect('login');
      }
      $login = $request->user()->UserMeta->UserRole->type ;
      if ($login == "role_admin" or $login == "role_user" ) {
         return $next($request);
    }
 return redirect('welcome');
    }
}
