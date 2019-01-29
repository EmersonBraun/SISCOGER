<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
    public function clearCache()
    {
        $exitCode = Artisan::call('cache:clear');
        toast()->success('Cache limpo!');
        return redirect()->route('home');
    }

    public function optimize(){
        $exitCode = Artisan::call('optimize');
        toast()->success('Classes otimizadas!');
        return redirect()->route('home');
    }
    
    public function routeCache()
    {
        $exitCode = Artisan::call('route:cache');
        toast()->success('Rotas em Cache!');
        return redirect()->route('home');
    }

    public function routeClear()
    {
        $exitCode = Artisan::call('route:clear');
        toast()->success('Rotas Limpas!');
        return redirect()->route('home');
    }

    public function viewCache()
    {
        $exitCode = Artisan::call('view:cache');
        toast()->success('Views em Cache!');
        return redirect()->route('home');
    }
    
    public function configCache()
    {
        $exitCode = Artisan::call('config:cache');
        toast()->success('Config em Cache!');
        return redirect()->route('home');
    }

}
