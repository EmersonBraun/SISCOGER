<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $e)
    {            
        if($this->isHttpException($e)) {
            $rota = $request->path();
            switch (intval($e->getStatusCode())) {
                // tempo ocioso
                case 401:
                    if($rota !== 'login') {
                        toast()->warning('401. Tempo ocioso!', 'ERRO!');
                        return redirect()->route('login');
                    } else {
                        return redirect()->route('viewlogin'); 
                    }
                    break;
                //proibido
                case 403:
                    activity()
                    ->withProperties(['wrongroute' => $rota])
                    ->log('O '.Auth::user().' tentou acessar a rota: '.$rota);
           
                    toast()->warning('Foi registrada a tentativa de acesso', 'LOG!');
                    toast()->error('Você não tem acesso a '.strtoupper($rota).'!', 'ERRO!');
                    return redirect()->route('home');
                    break;
                // not found
                case 404:
                    toast()->warning('esse caminho não existe!', 'ERRO!');
                    return redirect()->route('home');
                    break;
                // inatividade
                case 419:
                    toast()->warning('419. Tempo ocioso!', 'ERRO!');
                    return redirect()->route('logout');
                    break;

                // internal error
                case 500:
                    toast()->warning('500', 'ERRO!');
                    return false;
                    break;

                // serviço indisponível
                case 503:
                    toast()->warning('Indisponível!', 'ERRO!');
                    return redirect()->route('home');
                    break;

                default:
                    //Auth::logout();
                    //return redirect()->intended('login');
                    return parent::render($request, $e);
                    break;
            }
        } else {
            return parent::render($request, $e);
        }

        // if ($e instanceof \PDOException) {
        //     echo $e->getMessage();
        //     exit;
        //     // Auth::logout();
        //     // return redirect()->intended('login');
        // }

    }


}
