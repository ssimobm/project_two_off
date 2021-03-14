<?php

namespace App\Http\Middleware\Roles\permesion;

use Closure;

class Views
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

      $login_type = $request->user()->UserMeta->UserRole->type_value ;
      $login_type = json_decode($login_type)->view ;

      $login_roles = $login_type === 'yes' ?  $next($request) : redirect('home') ;
      return $login_roles ;
    }
}
