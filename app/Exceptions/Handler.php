<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Grimthorr\LaravelToast\Facade;
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
        if($this->isHttpException($e))
        {
            switch (intval($e->getStatusCode())) {
                //proibido
                case 403:
                    //pega a rota 
                    $rota = $request->path();
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
                    Auth::logout();
                    return redirect()->intended('login');
                    break;

                // internal error
                case 500:
                    Auth::logout();
                    return redirect()->intended('login');
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
        }
        else
        {
            return parent::render($request, $e);
        }
    }
    //return parent::render($request, $exception); antigo

}
