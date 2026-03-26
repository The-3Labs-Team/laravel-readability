<?php

use The3LabsTeam\Readability\ReadabilityServiceProvider;

it('boots the package service provider', function () {
    expect(app()->getProvider(ReadabilityServiceProvider::class))->not->toBeNull();
});
