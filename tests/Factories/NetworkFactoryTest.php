<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\Network;
use Rapkis\Controld\Factories\NetworkFactory;

it('builds a network', function (array $data, Network $expected) {
    expect((new NetworkFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'iata_code' => 'SYD',
            'city_name' => 'Sydney',
            'country_name' => 'AU',
            'location' => [
                'lat' => -111.1111,
                'long' => 222.2222,
            ],
            'status' => [
                'api' => 1,
                'dns' => 0,
                'pxy' => -1,
            ],
        ],
        new Network(
            iataCode: 'SYD',
            city: 'Sydney',
            country: 'AU',
            gpsLat: -111.1111,
            gpsLong: 222.2222,
            apiStatus: 1,
            dnsStatus: 0,
            proxyStatus: -1,
        ),
    ],
]);
