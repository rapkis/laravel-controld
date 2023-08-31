<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\Proxy;
use Rapkis\Controld\Factories\ProxyFactory;

it('builds a proxy', function (array $data, Proxy $expected) {
    expect((new ProxyFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'city' => 'Washington DC',
            'country' => 'US',
            'country_name' => 'United States',
            'PK' => 'WAS',
            'gps_lat' => 38.9047,
            'gps_long' => -77.0164,
            'uid' => 'United States:Washington DC',
        ],
        new Proxy(
            pk: 'WAS',
            uid: 'United States:Washington DC',
            country: 'US',
            countryName: 'United States',
            city: 'Washington DC',
            gpsLat: 38.9047,
            gpsLong: -77.0164,
        ),
    ],
]);
