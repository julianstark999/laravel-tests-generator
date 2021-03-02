<?php

namespace JulianStark999\LaravelTestsGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Julianstark999\LaravelTestsGenerator\LaravelTestsGenerator
 */
class LaravelTestsGeneratorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-tests-generator';
    }
}
