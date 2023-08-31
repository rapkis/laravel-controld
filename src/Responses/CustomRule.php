<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

class CustomRule
{
    public function __construct(
        public readonly string $pk,
        public readonly int $order,
        public readonly int $group,
        public readonly Action $action,
    ) {
    }
}
