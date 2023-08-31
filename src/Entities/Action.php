<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

use InvalidArgumentException;

class Action
{
    public function __construct(
        public readonly bool $status,
        public readonly ?int $do,
        public readonly ?string $via,
    ) {
        // TODO validate do. also make sure via is required if do = 2 or 3
        //        if ($this->do < 0 || $this->do > 3) {
        //            throw new InvalidArgumentException("Argument 'do' must be between 0 and 3");
        //        }
    }
}
