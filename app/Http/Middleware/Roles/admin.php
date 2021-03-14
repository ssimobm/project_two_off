<?php

namespace App\Http\Middleware\Roles;

use Closure;

class admin
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
      // Check Auth Login
      if (! $request->user()) {
      return redirect('login');
      }

      // Check Admin Super
      $login_user = $request->user()->AdminUser() ;
      // Check Admin

       $login_value = json_decode($request->user()->UserMeta->UserRole->type_value)->admin ;

      $login_type = ($login_value === 'yes') ?  $login_value  : $login_user ?? null ;

       return $login_type ?  $next($request) : redirect('home') ;


    }
}
