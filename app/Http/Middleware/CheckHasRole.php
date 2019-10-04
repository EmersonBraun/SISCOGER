<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role='')
    {
        $has = hasRoleTo($role);
        if(!$has) {
            toast()->error('Não tem papel: '.strtoupper($role),'ACESSO NEGADO!');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
