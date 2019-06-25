<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'SISCOGER'),
    'uploads' => '/arquivos',
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        JeroenNoten\LaravelAdminLte\ServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
        Reliese\Coders\CodersServiceProvider::class,
        Spatie\Permission\PermissionServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Laralabs\Toaster\ToasterServiceProvider::class,
        Fx3costa\LaravelChartJs\Providers\ChartjsServiceProvider::class,
        Grimthorr\LaravelToast\ServiceProvider::class,
        MaddHatter\LaravelFullcalendar\ServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        'Toast' => Grimthorr\LaravelToast\Facade::class,

        /*
         * Aliase for API
         */
        // PSWD
        'ApiTransferencias' => App\Http\Controllers\_Api\PSWD\TransferenciasApiController::class,
        // RHPR
        'ApiOPM' => App\Http\Controllers\_Api\RHPR\OPMApiController::class,
        'ApiPM' => App\Http\Controllers\_Api\RHPR\PolicialApiController::class,
        // SJD PM
        'ApiComportamento' => App\Http\Controllers\_Api\SJD\PM\ComportamentoApiController::class,
        'ApiDenunciados' => App\Http\Controllers\_Api\SJD\PM\DenunciadosApiController::class,
        'ApiElogios' => App\Http\Controllers\_Api\SJD\PM\ElogiosApiController::class,
        'ApiExcluidos' => App\Http\Controllers\_Api\SJD\PM\ExcluidosApiController::class,
        'ApiMedalhas' => App\Http\Controllers\_Api\SJD\PM\MedalhasApiController::class,
        'ApiMortosFeridos' => App\Http\Controllers\_Api\SJD\PM\MortosFeridosApiController::class,
        'ApiObitosLesoes' => App\Http\Controllers\_Api\SJD\PM\ObitosLesoesApiController::class,
        'ApiPresos' => App\Http\Controllers\_Api\SJD\PM\PresosApiController::class,
        'ApiProcedimento' => App\Http\Controllers\_Api\SJD\PM\ProcedimentoApiController::class,
        'ApiPunidos' => App\Http\Controllers\_Api\SJD\PM\PunidosApiController::class,
        'ApiReintegrados' => App\Http\Controllers\_Api\SJD\PM\ReintegradosApiController::class,
        'ApiRespondendo' => App\Http\Controllers\_Api\SJD\PM\RespondendoApiController::class,
        'ApiRestricoes' => App\Http\Controllers\_Api\SJD\PM\ComportamentoApiController::class,
        'ApiSai' => App\Http\Controllers\_Api\SJD\PM\SaiApiController::class,
        'ApiSuspensos' => App\Http\Controllers\_Api\SJD\PM\SuspensosApiController::class,
        // SJD Proc
        'ApiAdl' => App\Http\Controllers\_Api\SJD\Proc\AdlApiController::class,
        'ApiApfd' => App\Http\Controllers\_Api\SJD\Proc\ApfdApiController::class,
        'ApiCd' => App\Http\Controllers\_Api\SJD\Proc\CdApiController::class,
        'ApiCj' => App\Http\Controllers\_Api\SJD\Proc\CjApiController::class,
        'ApiDesercao' => App\Http\Controllers\_Api\SJD\Proc\DesercaoApiController::class,
        'ApiExclusao' => App\Http\Controllers\_Api\SJD\Proc\ExclusaoApiController::class,
        'ApiFatd' => App\Http\Controllers\_Api\SJD\Proc\FatdApiController::class,
        'ApiIpm' => App\Http\Controllers\_Api\SJD\Proc\IpmApiController::class,
        'ApiIso' => App\Http\Controllers\_Api\SJD\Proc\IsoApiController::class,
        'ApiIt' => App\Http\Controllers\_Api\SJD\Proc\ItApiController::class,
        'ApiMovimento' => App\Http\Controllers\_Api\SJD\Proc\MovimentoApiController::class,
        'ApiPad' => App\Http\Controllers\_Api\SJD\Proc\PadApiController::class,
        'ApiProcOutros' => App\Http\Controllers\_Api\SJD\Proc\ProcOutrosApiController::class,
        'ApiRecurso' => App\Http\Controllers\_Api\SJD\Proc\RecursoApiController::class,
        'ApiSindicancia' => App\Http\Controllers\_Api\SJD\Proc\SindicanciaApiController::class,
        'ApiSobrestamento' => App\Http\Controllers\_Api\SJD\Proc\SobrestamentoApiController::class,
        //repositórios
        'RepositoryAdl' => App\Repositories\AdlRepository::class,
        'RepositoryApfd' => App\Repositories\ApfdRepository::class,
        'RepositoryCd' => App\Repositories\CdRepository::class,
        'RepositoryCj' => App\Repositories\CjRepository::class,
        'RepositoryComportamento' => App\Repositories\ComportamentoRepository::class,
        'RepositoryDesercao' => App\Repositories\DesercaoRepository::class,
        'RepositoryExclusao' => App\Repositories\ExclusaoRepository::class,
        'RepositoryFatd' => App\Repositories\FatdRepository::class,
        'RepositoryIpm' => App\Repositories\IpmRepository::class,
        'RepositoryIso' => App\Repositories\IsoRepository::class,
        'RepositoryIt' => App\Repositories\ItRepository::class,
        'RepositoryOPM' => App\Repositories\OPMRepository::class,
        'RepositoryPad' => App\Repositories\PadRepository::class,
        'RepositoryPj' => App\Repositories\PjRepository::class,
        'RepositoryPolicial' => App\Repositories\PolicialRepository::class,
        'RepositoryProcOutro' => App\Repositories\ProcOutroRepository::class,
        'RepositoryRecurso' => App\Repositories\RecursoRepository::class,
        'RepositoryReintegrado' => App\Repositories\ReintegradoRepository::class,
        'RepositorySindicancia' => App\Repositories\SindicanciaRepository::class,
        'RepositoryTransferidos' => App\Repositories\TransferidosRepository::class,

    ],

];
