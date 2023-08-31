<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Proxy;

class ProxyFactory implements Factory
{
    public function make(array $data): Proxy
    {
        return new Proxy(
            pk: $data['PK'],
            uid: $data['uid'],
            country: $data['country'],
            countryName: $data['country_name'],
            city: $data['city'],
            gpsLat: $data['gps_lat'],
            gpsLong: $data['gps_long'],
        );
    }
}
