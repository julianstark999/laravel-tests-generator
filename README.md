<p align="center"><img src="https://banners.beyondco.de/laravel-tests-generator.png?theme=light&packageManager=composer+require&packageName=julianstark999%2Flaravel-tests-generator&pattern=circuitBoard&style=style_2&description=&md=1&showWatermark=0&fontSize=100px&images=database&widths=350&heights=350" alt="Social Card of Laravel Tests Generator"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/julianstark999/laravel-tests-generator.svg?style=flat-square)](https://packagist.org/packages/julianstark999/laravel-tests-generator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/julianstark999/laravel-tests-generator/run-tests?label=tests)](https://github.com/julianstark999/laravel-tests-generator/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/julianstark999/laravel-tests-generator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/julianstark999/laravel-tests-generator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/julianstark999/laravel-tests-generator.svg?style=flat-square)](https://packagist.org/packages/julianstark999/laravel-tests-generator)

# Create all missing Tests
This Laravel package provides a command to automatically generate all missing tests

## Installation

You can install the package via composer:

```bash
composer require julianstark999/laravel-tests-generator
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="JulianStark999\LaravelTestsGenerator\LaravelTestsGeneratorServiceProvider" --tag="laravel-tests-generator-config"
```

This is the contents of the published config file:

```php
return [
    'directories' => [
        'actions' => 'Actions',
        'commands' => 'Console\Commands', 
        'enums' => 'Enums', 
        'exceptions' => 'Exceptions', 
        'helper' => 'Helper', 
        'controllers' => 'Http\Controllers', 
        'middleware' => 'Http\Middleware', 
        'requests' => 'Http\Requests', 
        'resources' => 'Http\Resources', 
        'jobs' => 'Jobs', 
        'mail' => 'Mail', 
        'models' => 'Models', 
        'notifications' => 'Notifications', 
        'observers' => 'Observers', 
        'providers' => 'Providers', 
        'rules' => 'Rules', 
        'services' => 'Services', 
        'traits' => 'Traits', 
        'views' => 'View',
    ],
];
```

## Usage

### Commands

#### tests-generator {--dir=*}

The `tests-generator` command generates missing tests
```bash
php artisan tests-generator {--dir=*}

# example
php artisan tests-generator --dir=controllers 
```
**See the configuration file example or publish it yourself for all available dirs**

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Julian Stark](https://github.com/julianstark999)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
