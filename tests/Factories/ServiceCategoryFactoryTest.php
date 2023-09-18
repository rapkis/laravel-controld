<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\ServiceCategory;
use Rapkis\Controld\Factories\ServiceCategoryFactory;

it('builds a service category', function (array $data, ServiceCategory $expected) {
    expect((new ServiceCategoryFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'audio',
            'name' => 'Audio',
            'description' => 'Description',
            'count' => 15,
        ],
        new ServiceCategory(
            pk: 'audio',
            name: 'Audio',
            description: 'Description',
            count: 15,
        ),
    ],
]);
