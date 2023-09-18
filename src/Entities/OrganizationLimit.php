<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class OrganizationLimit
{
    public function __construct(
        public readonly int $count,
        public readonly ?int $max,
        public readonly ?float $price,
    ) {
    }
}
