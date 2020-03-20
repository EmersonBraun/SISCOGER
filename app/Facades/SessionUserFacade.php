<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class SessionUserFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'sessionuser';
    }
}