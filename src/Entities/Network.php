<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Network
{
    public function __construct(
        public readonly string $iataCode,
        public readonly string $city,
        public readonly string $country,
        public readonly float $gpsLat,
        public readonly float $gpsLong,
        public readonly int $apiStatus,
        public readonly int $dnsStatus,
        public readonly int $proxyStatus,
    ) {
    }
}
