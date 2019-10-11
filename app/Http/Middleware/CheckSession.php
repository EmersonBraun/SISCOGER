<?php

namespace App\Http\Middleware;

use Closure;

class CheckSession
{
    /**
     * verificar se existe a sessão, caso não tenha, desloga.
     */
    public function handle($request, Closure $next)
    {
        if ( !session('rg') ) abort(401,'Not Logged');

        return $next($request);
    }
}
