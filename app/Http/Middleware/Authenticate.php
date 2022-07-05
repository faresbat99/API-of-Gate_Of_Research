<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    public function handle($request, Closure $next, ...$guards)
    {
      if (  $jwt=$request->cookie('jwt')){
           $request->headers->set('Authorization','Bearer '. $jwt);//we make a header has cookie jwt
      };//we get JWT, and we want to pass it as bearer header  and if it set it will go to if condition
        $this->authenticate($request, $guards);

        return $next($request);
    }
}
