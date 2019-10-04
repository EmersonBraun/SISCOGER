<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission='')
    {
        $has = hasPermissionTo($permission);
        if(!$has) {
            toast()->error('Não tem permissão: '.strtoupper($permission),'ACESSO NEGADO!');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
