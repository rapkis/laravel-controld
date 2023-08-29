<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class ProfileOption
{
    public function __construct(
        public readonly string $pk,
        public readonly string $title,
        public readonly string $description,
        public readonly string $type,
        public readonly mixed $default,
        public readonly string $infoUrl,
    ) {
    }
}
