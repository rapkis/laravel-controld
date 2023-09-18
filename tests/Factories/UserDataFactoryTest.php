<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Rapkis\Controld\Factories\UserDataFactory;
use Rapkis\Controld\Responses\UserData;

it('builds user data', function (array $data, UserData $expected) {
    expect((new UserDataFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'date' => '2000-01-01',
            'email_status' => 0,
            'email' => 'test@example.com',
            'stats_endpoint' => 'europe',
            'proxy_access' => 1,
            'status' => 1,
            'last_active' => 111111111,
            'PK' => 'user_pk',
            'twofa' => 0,
        ],
        new UserData(
            pk: 'user_pk',
            date: CarbonImmutable::make('2000-01-01'),
            status: true,
            email: 'test@example.com',
            emailStatus: false,
            tutorials: true,
            v: 2,
            proxyAccess: true,
            lastActive: 111111111,
            twoFactorAuthentication: false,
            analyticsRegion: 'europe',
            debug: [],
        ),
    ],
    [
        [
            // same as above
            'date' => '2000-01-01',
            'email_status' => 0,
            'email' => 'test@example.com',
            'stats_endpoint' => 'europe',
            'proxy_access' => 1,
            'status' => 1,
            'last_active' => 111111111,
            'PK' => 'user_pk',
            'twofa' => 0,
            // new
            'tutorials' => 1, // means turned off
            'v' => 1,
            'debug' => ['test'],
        ],
        new UserData(
            pk: 'user_pk',
            date: CarbonImmutable::make('2000-01-01'),
            status: true,
            email: 'test@example.com',
            emailStatus: false,
            tutorials: false,
            v: 1,
            proxyAccess: true,
            lastActive: 111111111,
            twoFactorAuthentication: false,
            analyticsRegion: 'europe',
            debug: ['test'],
        ),
    ],
]);
