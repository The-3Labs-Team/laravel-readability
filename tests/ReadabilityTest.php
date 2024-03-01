<?php

use The3LabsTeam\Readability\Facades\Readability;

it('cannot parse a non html', function () {
    $html = 'This is a test';
    expect(function () use ($html) {
        Readability::parse($html);
    })->toThrow(Exception::class);
});

it('can parse and get the title', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $parsed = Readability::parse($html);
    $title = $parsed->getTitle();
    expect($title)->toBe('Bitcoin: A Peer-to-Peer Electronic Cash System');
});

it('can parse and get excerpt', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $excerpt = Readability::parse($html)->getExcerpt();
    expect($excerpt)->toBe('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
});

it('can parse and get the author', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $author = Readability::parse($html)->getAuthor();
    expect($author)->toBe('Satoshi Nakamoto');
});

it('can parse and get the image', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $image = Readability::parse($html)->getImage();
    expect($image)->toBe('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
});

it('can parse and get images', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
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

it('can parse and get the content', function () {
    $html = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $readability = Readability::parse($html);
    $readability->getContent();
    expect($readability)->not->toBeNull();
});
