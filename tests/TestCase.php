<?php

namespace Castelnuovo\LaravelEnv\Tests;

use Castelnuovo\LaravelEnv\LaravelEnvServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelEnvServiceProvider::class,
        ];
    }
}
