<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Proxy
{
    public function __construct(
        public readonly string $pk,
        public readonly string $uid,
        public readonly string $country,
        public readonly string $countryName,
        public readonly string $city,
        public readonly float $gpsLat,
        public readonly float $gpsLong
    ) {
    }
}
