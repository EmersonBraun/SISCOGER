<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckSession
{
    /**
     * verificar se existe a sessão, caso não tenha, desloga.
     */
    public function handle($request, Closure $next)
    {
        if (!session('rg')) {
            Auth::logout();
            // return redirect()->route('login');
        }
        return $next($request);
    }
}
