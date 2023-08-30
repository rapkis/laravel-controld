<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Service;
use Rapkis\Controld\Entities\ServiceAction;

class ServiceFactory implements Factory
{
    public function make(array $data): Service
    {
        if (! empty($data['action'])) {
            $action = new ServiceAction(
                do: $data['action']['do'],
                status: (bool) $data['action']['status'],
                via: $data['action']['via'] ?? null,
            );
        }

        return new Service(
            pk: $data['PK'],
            category: $data['category'],
            name: $data['name'],
            unlockLocation: $data['unlock_location'],
            locations: $data['locations'] ?? [],
            warning: $data['warning'] ?? null,
            action: $action ?? null,
        );
    }
}
