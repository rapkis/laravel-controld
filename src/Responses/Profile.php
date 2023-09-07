<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use Rapkis\Controld\Entities\ProfileFilters;

class Profile
{
    public function __construct(
        public readonly string $pk,
        public readonly int $updated,
        public readonly string $name,
        public readonly ?int $disableTtl,
        public readonly ?int $stats,
        public readonly ?ProfileFilters $filters,
    ) {
    }
}
