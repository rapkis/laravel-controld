<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\LearnedIp;

class LearnedIpFactory implements Factory
{
    public function make(array $data): LearnedIp
    {
        return new LearnedIp(
            ip: $data['ip'],
            timestamp: (int) $data['ts'],
            isp: $data['isp'],
            country: $data['country'] ?? null,
            city: $data['city'] ?? null,
        );
    }
}
