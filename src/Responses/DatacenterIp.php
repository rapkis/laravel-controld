<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

class DatacenterIp
{
    public function __construct(
        public readonly string $ip,
        public readonly string $type,
        public readonly string $organization,
        public readonly string $country,
        public readonly string $handler,
    ) {
    }
}
