<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Filter
{
    /**
     * @param  array<string>  $sources
     * @param  array<FilterOption>  $options
     * @param  array<DnsResolver>  $resolvers
     */
    public function __construct(
        public readonly string $pk,
        public readonly string $name,
        public readonly string $description,
        public readonly string $additional,
        public readonly array $sources,
        public readonly array $options,
        public readonly array $resolvers,
        public readonly bool $status,
    ) {
    }
}
