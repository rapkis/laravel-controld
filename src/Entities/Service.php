<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Service
{
    public function __construct(
        public readonly string $pk,
        public readonly string $category,
        public readonly string $name,
        public readonly string $unlockLocation,
        public readonly array $locations,
        public readonly ?string $warning,
        public readonly ?Action $action,
    ) {
    }
}
