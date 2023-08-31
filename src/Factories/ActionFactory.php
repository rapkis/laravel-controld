<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Responses\Action;

class ActionFactory implements Factory
{
    public function make(array $data): Action
    {
        return new Action(
            status: (bool) $data['status'],
            do: $data['do'] ?? null,
            via: $data['via'] ?? null,
            ttl: $data['ttl'] ?? null,
        );
    }
}
