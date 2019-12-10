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
            dd('here');
            // Auth::logout();
            return redirect()->to('/login');
        }
        return $next($request);
    }
}
