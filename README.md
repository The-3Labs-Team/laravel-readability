<p align="center"><img src="https://github.com/the-3labs-team/laravel-readability/raw/HEAD/art/banner.png" width="100%" alt="Logo Laravel Readability"></p>

# Laravel Readability

[![Latest Version on Packagist](https://img.shields.io/packagist/v/the-3labs-team/laravel-readability.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-readability)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-readability/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/the-3labs-team/laravel-readability/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Github PHPStan](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-readability/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/the-3labs-team/laravel-readability/actions?query=workflow%3Aphpstan+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-readability/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/the-3labs-team/laravel-readability/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Maintainability](https://api.codeclimate.com/v1/badges/0fcf8cc60952fcc6d286/maintainability)](https://codeclimate.com/github/The-3Labs-Team/laravel-readability/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/0fcf8cc60952fcc6d286/test_coverage)](https://codeclimate.com/github/The-3Labs-Team/laravel-readability/test_coverage)
![License Mit](https://img.shields.io/github/license/murdercode/laravel-shortcode-plus)
[![Total Downloads](https://img.shields.io/packagist/dt/the-3labs-team/laravel-readability.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-readability)

This package is a Laravel wrapper for [readability.php](https://github.com/fivefilters/readability.php). It provides a
simple way to extract the main content from a webpage.

## Installation

You can install the package via composer:

```bash
composer require the-3labs-team/laravel-readability
```

Since it uses the readability.php package, you will need the following PHP extensions:

```bash
$ sudo apt-get install php7.4-xml php7.4-mbstring
```

Please change the version according to your PHP version.

## Usage

```php
$html = '<html>...</html>';
$parsed = Readability::parse($html);
$title = $parsed->getTitle();
```

You can use the same methods as the original package. Please refer to
the [readability.php documentation](https://github.com/fivefilters/readability.php).

```php
$html = '<html>...</html>';
$parsed = Readability::parse($html);

$title = $parsed->getTitle();
$content = $parsed->getContent();
$excerpt = $parsed->getExcerpt();
$author = $parsed->getAuthor();
$direction = $parsed->getDirection();
$image = $parsed->getImage();
$images = $parsed->getImages();
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

- [Stefano Novelli](https://github.com/murdercode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
