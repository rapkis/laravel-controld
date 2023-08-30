<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class FilterOption
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $type,
        public readonly string $name,
        public readonly bool $status,
    ) {
    }
}
