<?php

it('will only define the helpers when calling the register function', function () {
    expect(function_exists('requiresMinPhpVersion'))->toBeFalse();

    registerSpatiePestHelpers();

    expect(function_exists('requiresMinPhpVersion'))->toBeTrue();
})->skip(getenv('RUN_HELPERS_TEST') !== 'true', 'This test runs only in isolation.');
