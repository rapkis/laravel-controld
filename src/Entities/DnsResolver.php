<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class DnsResolver
{
    /**
     * @param  array<string>  $values IP, DoH, DoT addresses
     */
    public function __construct(
        public readonly string $type,
        public readonly array $values,
    ) {
    }
}
