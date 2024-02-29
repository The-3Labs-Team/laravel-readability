<?php

use The3LabsTeam\Readability\Facades\Readability;

it('cannot parse a non html', function () {
    $content = 'This is a test';
    expect(function () use ($content) {
        Readability::parse($content);
    })->toThrow(Exception::class);
});

it('can parse and get the title', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $title = Readability::parse($content)->getTitle();
    expect($title)->toBe('Bitcoin: A Peer-to-Peer Electronic Cash System');
});

it('can parse and get excerpt', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $excerpt = Readability::parse($content)->getExcerpt();
    expect($excerpt)->toBe('A purely peer-to-peer version of electronic cash would allow online payments to be sent directly from one party to another without going through a financial institution.');
});

it('can parse and get the author', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $author = Readability::parse($content)->getAuthor();
    expect($author)->toBe('Satoshi Nakamoto');
});

it('can parse and get the image', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $image = Readability::parse($content)->getImage();
    expect($image)->toBe('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
});

it('can parse and get images', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $images = Readability::parse($content)->getImages();
    expect($images)->toBeArray()->toHaveCount(8);
    expect($images)->toContain('https://www.bitcoin.com/wp-content/uploads/2020/10/bitcoin-whitepaper-featured-image.jpg');
    expect($images)->toContain('/static/img/bitcoin/transactions.svg');
    expect($images)->toContain('/static/img/bitcoin/timestamp-server.svg');
    expect($images)->toContain('/static/img/bitcoin/proof-of-work.svg');
    expect($images)->toContain('/static/img/bitcoin/reclaiming-disk-space.svg');
    expect($images)->toContain('/static/img/bitcoin/simplified-payment-verification.svg');
    expect($images)->toContain('/static/img/bitcoin/combining-splitting-value.svg');
    expect($images)->toContain('/static/img/bitcoin/privacy.svg');
});

it('can parse and get the content', function () {
    $content = file_get_contents(__DIR__ . '/fixtures/demo.html');
    $readability = Readability::parse($content);
    $readability->getContent();
    expect($readability)->not->toBeNull();
});
