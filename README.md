# Monitor Metric of laravel disks

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adamhut/laravel-disk-monitor.svg?style=flat-square)](https://packagist.org/packages/adamhut/laravel-disk-monitor)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/adamhut/laravel-disk-monitor/run-tests?label=tests)](https://github.com/adamhut/laravel-disk-monitor/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/adamhut/laravel-disk-monitor.svg?style=flat-square)](https://packagist.org/packages/adamhut/laravel-disk-monitor)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require adamhut/laravel-disk-monitor
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Adamhut\DiskMonitor\DiskMonitorServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Adamhut\DiskMonitor\DiskMonitorServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$laravel-disk-monitor = new Adamhut\LaravelDiskMonitor();
echo $laravel-disk-monitor->echoPhrase('Hello, Adamhut!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@adamhut.be instead of using the issue tracker.

## Credits

- [Adam Huang](https://github.com/AdamHuang)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
