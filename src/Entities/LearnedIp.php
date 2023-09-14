<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class LearnedIp
{
    public function __construct(
        public readonly string $ip,
        public readonly int $timestamp,
        public readonly string $isp,
        public readonly ?string $country,
        public readonly ?string $city,
    ) {
    }
}
