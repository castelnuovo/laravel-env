<?php

namespace Castelnuovo\LaravelEnv\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Castelnuovo\LaravelEnv\LaravelEnv
 */
class LaravelEnv extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Castelnuovo\LaravelEnv\LaravelEnv::class;
    }
}
