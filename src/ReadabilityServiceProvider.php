<?php

namespace The3LabsTeam\Readability;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use The3LabsTeam\Readability\Commands\ReadabilityCommand;

class ReadabilityServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-readability')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-readability_table')
            ->hasCommand(ReadabilityCommand::class);
    }
}
