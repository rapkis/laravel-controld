<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class DynamicDns
{
    public function __construct(
        public readonly bool $status,
        public readonly string $hostname,
        public readonly ?string $subdomain,
        public readonly ?string $record,
    ) {
    }
}
