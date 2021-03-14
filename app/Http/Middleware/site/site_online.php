<?php

namespace App\Http\Middleware\site;

use Closure;
use App\Options;
class site_online
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

      // $login_type = Options::where('option_name', 'Setting_SiteActive')->first()->option_value ;
      // $login_roles = $login_type === 'check_True' ?  $next($request) : redirect('home') ;
      // return $login_roles ;
      return  $next($request) ;

    }
}
