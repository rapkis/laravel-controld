<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use Rapkis\Controld\Entities\Action;

class RuleFolder
{
    public function __construct(
        public readonly int $pk,
        public readonly string $group,
        public readonly Action $action,
        public readonly int $count
    ) {
    }
}
