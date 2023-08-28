<?php

namespace Rapkis\Controld;

use Illuminate\Contracts\Foundation\Application;
use Rapkis\Controld\Api\ControlD;
use Rapkis\Controld\Api\ControlDFactory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ControldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-controld')
            ->hasConfigFile();
    }

    public function boot()
    {
        $this->app->bind(
            ControlD::class,
            fn (Application $app) => $app->make(ControlDFactory::class)->make(),
        );
    }
}
