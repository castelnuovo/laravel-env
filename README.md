<p align="center">
  <img src="https://assets.castelnuovo.dev/logo.svg" width="100" />
</p>

<h1 align="center">
  castelnuovo/laravel-env
</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/castelnuovo/laravel-env.svg?style=flat-square)](https://packagist.org/packages/castelnuovo/laravel-env)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/castelnuovo/laravel-env/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/castelnuovo/laravel-env/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/castelnuovo/laravel-env/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/castelnuovo/laravel-env/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/castelnuovo/laravel-env.svg?style=flat-square)](https://packagist.org/packages/castelnuovo/laravel-env)

Encrypt and decrypt environment files in Laravel

## Installation

You can install the package via composer:

```bash
composer require castelnuovo/laravel-env
```

## Usage

```sh
# Create production environment file
cp .env .env.production

# Generate a key and encrypt an environment file
php artisan env:encrypt --env production

# Decrypt and edit an environment file
php artisan env:edit production
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
