<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Responses\DatacenterIp;

class DatacenterIpFactory implements Factory
{
    public function make(array $data): DatacenterIp
    {
        return new DatacenterIp(
            ip: $data['ip'],
            type: $data['type'],
            organization: $data['org'],
            country: $data['country'],
            handler: $data['handler'],
        );
    }
}
