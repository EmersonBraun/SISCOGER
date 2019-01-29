<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Auth;
use Session;
 
class SessionDataCheckMiddleware {
 
    /**
     * Check session data, if role is not valid logout the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        //pega algo que é para estar na sessão
        $sessao = session()->get('rg');
        //caso não esteja redireciona para o logout
        if ($sessao == '' || $sessao == NULL) {
            
            //session()->flush(); // remove all the session data
            
            Auth::logout(); // logout user
            
        }
 
        return $next($request);
    }
 
}