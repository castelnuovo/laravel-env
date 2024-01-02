<?php

namespace Castelnuovo\LaravelEnv;

use Castelnuovo\LaravelEnv\Commands\LaravelEnvCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelEnvServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-env')
            ->hasConfigFile()
            ->hasCommand(LaravelEnvCommand::class);
    }
}
