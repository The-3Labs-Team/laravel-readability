<?php

use The3LabsTeam\Readability\Facades\Readability;
use The3LabsTeam\Readability\Readability as ReadabilityClass;

//./vendor/bin/pest tests/ReadabilityTest.php

it('cannot parse a non html', function () {
    $html = 'This is a test';
    expect(function () use ($html) {
        Readability::parse($html);
    })->toThrow(Exception::class);
});

it('cannot parse a non html from ReadabilityClass', function () {
    $html = 'This is a test';
    expect(function () use ($html) {
        $readability = new ReadabilityClass($html);
        $readability->parse();
    })->toThrow(Exception::class);
});

it('can parse and get the title', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $parsed = Readability::parse($html);
    $title = $parsed->getTitle();
    expect($title)->toBe('Bitcoin: A Peer-to-Peer Electronic Cash System');
});

it('can parse and get the title from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $parsed = (new ReadabilityClass($html))->parse();
    $title = $parsed->getTitle();
    expect($title)->toBe('Bitcoin: A Peer-to-Peer Electronic Cash System');
});


it('can parse and get excerpt', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $excerpt = Readability::parse($html)->getExcerpt();
    expect($excerpt)->toBe('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
});

it('can parse and get excerpt from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $excerpt = (new ReadabilityClass($html))->parse()->getExcerpt();
    expect($excerpt)->toBe('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
});

it('can parse and get the author', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $author = Readability::parse($html)->getAuthor();
    expect($author)->toBe('Satoshi Nakamoto');
});

it('can parse and get the author from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $author = (new ReadabilityClass($html))->parse()->getAuthor();
    expect($author)->toBe('Satoshi Nakamoto');
});

it('can parse and get the image', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $image = Readability::parse($html)->getImage();
    expect($image)->toBe('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
});

it('can parse and get the image from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $image = (new ReadabilityClass($html))->parse()->getImage();
    expect($image)->toBe('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
});

it('can parse and get images', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $images = Readability::parse($html)->getImages();
    expect($images)->toBeArray()->toHaveCount(8)
        ->and($images)->toContain('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg')
        ->and($images)->toContain('/static/img/bitcoin/transactions.svg')
        ->and($images)->toContain('/static/img/bitcoin/timestamp-server.svg')
        ->and($images)->toContain('/static/img/bitcoin/proof-of-work.svg')
        ->and($images)->toContain('/static/img/bitcoin/reclaiming-disk-space.svg')
        ->and($images)->toContain('/static/img/bitcoin/simplified-payment-verification.svg')
        ->and($images)->toContain('/static/img/bitcoin/combining-splitting-value.svg')
        ->and($images)->toContain('/static/img/bitcoin/privacy.svg');
});

it('can parse and get images from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $images = (new ReadabilityClass($html))->parse()->getImages();
    expect($images)->toBeArray()->toHaveCount(8)
        ->and($images)->toContain('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg')
        ->and($images)->toContain('/static/img/bitcoin/transactions.svg')
        ->and($images)->toContain('/static/img/bitcoin/timestamp-server.svg')
        ->and($images)->toContain('/static/img/bitcoin/proof-of-work.svg')
        ->and($images)->toContain('/static/img/bitcoin/reclaiming-disk-space.svg')
        ->and($images)->toContain('/static/img/bitcoin/simplified-payment-verification.svg')
        ->and($images)->toContain('/static/img/bitcoin/combining-splitting-value.svg')
        ->and($images)->toContain('/static/img/bitcoin/privacy.svg');
});

it('can parse and get the direction', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $direction = Readability::parse($html)->getDirection();
    expect($direction)->toBe('ltr');
});

it('can parse and get the direction from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $direction = (new ReadabilityClass($html))->parse()->getDirection();
    expect($direction)->toBe('ltr');
});

it('can parse and get the content', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $readability = Readability::parse($html);
    $readability->getContent();
    expect($readability)->not->toBeNull();
});

it('can parse and get the content from ReadabilityClass', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $readability = (new ReadabilityClass($html))->parse();
    $content = $readability->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
});

it('can parse and get the content with source list', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo-with-iframe.html');
    $content = (new ReadabilityClass($html))->addSourceList(['facebook.com'])->parse()->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
    expect($content)->toContain('https://www.facebook.com/v3.2/plugins/post');
});

it('can parse and get the content with source list with specific URL', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo-with-iframe.html');
    $content = (new ReadabilityClass($html))->addSourceList(['facebook.com/v3.2/plugins'])->parse()->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
    expect($content)->toContain('https://www.facebook.com/v3.2/plugins/post');
    expect($content)->not->toContain('https://www.facebook.com/posts/');
});


it('can parse and get the content without source list', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo.html');
    $content = (new ReadabilityClass($html))->addSourceList(['facebook.com'])->parse()->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
    expect($content)->not->toContain('https://www.facebook.com/v3.2/plugins/post');
});

it('can parse and get the content with all source list', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo-with-iframe.html');
    $content = (new ReadabilityClass($html))->addSourceList()->parse()->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('https://satoshi.nakamotoinstitute.org');
    expect($content)->toContain('https://www.facebook.com/v3.2/plugins/post');
    expect($content)->toContain('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
});

it('can parse and get the content with source list (regex)', function () {
    $html = file_get_contents(__DIR__.'/fixtures/demo-with-iframe.html');
    $content = (new ReadabilityClass($html))->addSourceList(['/twitter\.com\/.*\/status\/\d+/'])->parse()->getContent();
    expect($content)->not->toBeNull();
    expect($content)->toContain('https://twitter.com/TomsHWItalia/status/1927702682380149224?ref_src=twsrc%5Etfw');
    expect($content)->not->toContain('https://twitter.com/DA_NON_PRENDERE');
});