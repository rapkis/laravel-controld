<?php

namespace Rapkis\Controld;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Rapkis\Controld\Commands\ControldCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-controld_table')
            ->hasCommand(ControldCommand::class);
    }
}
