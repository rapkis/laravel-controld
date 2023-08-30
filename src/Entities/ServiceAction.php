<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

use InvalidArgumentException;

class ServiceAction
{
    public function __construct(
        public readonly int $do,
        public readonly bool $status,
        public readonly ?string $via,
    ) {
        //        if ($this->do < 0 || $this->do > 3) {
        //            throw new InvalidArgumentException("Argument 'do' must be between 0 and 3");
        //        }
    }
}
