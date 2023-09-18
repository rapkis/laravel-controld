<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class ServiceCategory
{
    public function __construct(
        public readonly string $pk,
        public readonly string $name,
        public readonly string $description,
        public readonly int $count,
    ) {
    }
}
