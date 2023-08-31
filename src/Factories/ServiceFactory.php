<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Entities\Service;

class ServiceFactory implements Factory
{
    public function make(array $data): Service
    {
        if (! empty($data['action'])) {
            $action = new Action(
                status: (bool) $data['action']['status'],
                do: $data['action']['do'],
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
