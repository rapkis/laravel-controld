<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\ServiceCategory;

class ServiceCategoryFactory implements Factory
{
    public function make(array $data): ServiceCategory
    {
        return new ServiceCategory(
            pk: $data['PK'],
            name: $data['name'],
            description: $data['description'],
            count: (int) $data['count'],
        );
    }
}
