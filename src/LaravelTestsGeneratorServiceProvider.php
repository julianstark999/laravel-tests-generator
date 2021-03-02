<?php

namespace JulianStark999\LaravelTestsGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Julianstark999\LaravelTestsGenerator\Commands\LaravelTestsGeneratorCommand;

class LaravelTestsGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-tests-generator')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_tests_generator_table')
            ->hasCommand(LaravelTestsGeneratorCommand::class);
    }
}
