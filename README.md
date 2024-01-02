# Encrypt and decrypt environment files in Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/castelnuovo/laravel-env.svg?style=flat-square)](https://packagist.org/packages/castelnuovo/laravel-env)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/castelnuovo/laravel-env/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/castelnuovo/laravel-env/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/castelnuovo/laravel-env/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/castelnuovo/laravel-env/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/castelnuovo/laravel-env.svg?style=flat-square)](https://packagist.org/packages/castelnuovo/laravel-env)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require castelnuovo/laravel-env
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-env-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$LaravelEnv = new Castelnuovo\LaravelEnv();
echo $LaravelEnv->echoPhrase('Hello, castelnuovo!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Luca Castelnuovo](https://github.com/lucacastelnuovo)
-   [Egidius Mengelberg](https://github.com/egidiusmengelberg)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
