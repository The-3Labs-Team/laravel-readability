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
use The3LabsTeam\LaravelReadability\Facades\Readability;

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

### Get the source list

```php
use The3LabsTeam\LaravelReadability\Readability as ReadabilityClass;

$html = '<html>...</html>';
$parse = (new ReadabilityClass($html))
->getSourceList(
    domainWhitelist: ['example.com', 'another-example.com/some-path'],
    tagsToExtract: ['a', 'iframe', 'text'] // Optional, default is ['a', 'iframe']
)
->parse();
$content = $parsed->getContent();
```

´$content´ will contain the list of sources in the article.

```html
...
<p>Source list: https://example.com/source1, https://example.com/source2</p>
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

## Sponsor

<div>  
    <a href="https://www.tomshw.it/" target="_blank" rel="noopener noreferrer">
        <img  src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/toms.png" alt="Tom's Hardware - Notizie, recensioni, guide all'acquisto e approfondimenti per tutti gli appassionati di computer, smartphone, videogiochi, film, serie tv, gadget e non solo" />  
    </a>
    <a href="https://spaziogames.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/spazio.png" alt="Spaziogames - Tutto sul mondo dei videogiochi. Troverai tantissime anteprime, recensioni, notizie dei giochi per tutte le console, PC, iPhone e Android." />
    </a>
    <br/>
    <a href="https://cpop.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/cpop.png" alt="Cpop - News, recensioni, guide su fumetto, cinema & serie TV, gioco da tavolo e di ruolo e collezionismo. Tutto quello di cui hai bisogno per rimanere aggiornato sul mondo della cultura pop"/>
    </a>
    <a href="https://data4biz.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/d4b.png" alt="Data4Biz - Sito dedicato alla trasformazione digitale del business" />
    </a>
    <br/>
    <a href="https://soshomegarden.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/sos.png" alt="SOS Home & Garden - Realtà dedicata a 360 gradi ai settori della casa e del giardino." />
    </a>
    <a href="https://global.techradar.com/it-it" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/techradar.png" alt="Techradar - Le ultime notizie e recensioni dal mondo della tecnologia, su computer, sistemi per la casa, gadget e altro." />
    </a>
    <br/>
    <a href="https://aibay.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/aibay.png" alt="Aibay - Scopri AiBay, il leader delle notizie sull'intelligenza artificiale. Resta aggiornato sulle ultime innovazioni, ricerche e tendenze del mondo AI con approfondimenti, interviste esclusive e analisi dettagliate." />
    </a>
    <a href="https://coinlabs.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/coinlabs.png" alt="Coinlabs - Notizie, analisi approfondite, guide e opinioni aggiornate sul mondo delle criptovalute, blockchain e finanza" />
    </a>

</div>

