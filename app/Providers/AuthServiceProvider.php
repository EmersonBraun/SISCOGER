<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        // $gate->before(function ($user, $ability) {
        //     if(in_array($user->rg, config('sistema.super-users')))
        //     {
                
        //         return true;
        //     }
        // });
    }
}
