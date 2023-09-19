<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Permission
{
    public function __construct(
        public readonly int $level,
        public readonly string $printable,
    ) {
    }
}
