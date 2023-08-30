<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\DnsResolver;
use Rapkis\Controld\Entities\Filter;
use Rapkis\Controld\Entities\FilterOption;

class FilterFactory implements Factory
{
    public function make(array $data): Filter
    {
        return new Filter(
            pk: $data['PK'],
            name: $data['name'],
            description: $data['description'] ?? '',
            additional: $data['additional'] ?? '',
            sources: $data['sources'] ?? [],
            options: $this->makeOptions($data['options'] ?? []),
            resolvers: $this->makeResolvers($data['resolvers'] ?? []),
            status: (bool) $data['status'],
        );
    }

    /**
     * @return array<FilterOption>
     */
    private function makeOptions(array $optionData): array
    {
        $result = [];
        foreach ($optionData as $option) {
            $option = new FilterOption(
                title: $option['title'],
                description: $option['description'],
                type: $option['type'],
                name: $option['name'],
                status: (bool) $option['status'],
            );
            $result[$option->name] = $option;
        }

        return $result;
    }

    /**
     * @return array<DnsResolver>
     */
    private function makeResolvers(array $resolverData): array
    {
        $result = [];
        foreach ($resolverData as $type => $resolver) {
            $resolver = new DnsResolver(
                type: $type,
                values: $resolver,
            );
            $result[$resolver->type] = $resolver;
        }

        return $result;
    }
}
