<?php

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Network;

class NetworkFactory implements Factory
{
    public function make(array $data): Network
    {
        return new Network(
            iataCode: $data['iata_code'],
            city: $data['city_name'],
            country: $data['country_name'],
            gpsLat: (float) $data['location']['lat'],
            gpsLong: (float) $data['location']['long'],
            apiStatus: (int) $data['status']['api'],
            dnsStatus: (int) $data['status']['dns'],
            proxyStatus: (int) $data['status']['pxy'],
        );
    }
}
