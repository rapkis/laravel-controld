<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\DeviceType;

class DeviceTypeFactory implements Factory
{
    public function make(array $data): DeviceType
    {
        return new DeviceType(
            type: $data['type'],
            name: $data['name'],
            icons: $data['icons'],
            setupUrl: $data['setup_url'] ?? null,
        );
    }
}
