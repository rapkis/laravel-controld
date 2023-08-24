<?php

namespace Rapkis\Controld;

use Rapkis\Controld\Commands\ControldCommand;
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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-controld_table')
            ->hasCommand(ControldCommand::class);
    }
}
