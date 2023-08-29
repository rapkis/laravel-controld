<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\ProfileFilters;
use Rapkis\Controld\Factories\ProfileFactory;
use Rapkis\Controld\Responses\Profile;

it('builds a profile', function (array $data, Profile $expected) {
    expect((new ProfileFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => '123test123',
            'updated' => 111111111,
            'name' => 'Test',
            'profile' => [
                'flt' => ['count' => 3],
                'cflt' => ['count' => 0],
                'ipflt' => ['count' => 0],
                'rule' => ['count' => 0],
                'svc' => ['count' => 1],
                'grp' => ['count' => 0],
                'opt' => [
                    'count' => 0,
                    'data' => [],
                ],
                'da' => [],
            ],
        ],
        new Profile(
            pk: '123test123',
            updated: 111111111,
            name: 'Test',
            disableTtl: null,
            stats: null,
            filters: new ProfileFilters(
                flt: ['count' => 3],
                cflt: ['count' => 0],
                ipflt: ['count' => 0],
                rule: ['count' => 0],
                svc: ['count' => 1],
                grp: ['count' => 0],
                opt: [
                    'count' => 0,
                    'data' => [],
                ],
                da: [],
            )
        ),
    ],
    [
        [
            'PK' => '123test123',
            'updated' => 111111111,
            'name' => 'Test',
            'disable_ttl' => 1695971151,
            'stats' => 1,
            'profile' => [
                'flt' => ['count' => 3],
                'cflt' => ['count' => 0],
                'ipflt' => ['count' => 0],
                'rule' => ['count' => 0],
                'svc' => ['count' => 1],
                'grp' => ['count' => 0],
                'opt' => [
                    'count' => 0,
                    'data' => [],
                ],
                'da' => [],
            ],
        ],
        new Profile(
            pk: '123test123',
            updated: 111111111,
            name: 'Test',
            disableTtl: 1695971151,
            stats: 1,
            filters: new ProfileFilters(
                flt: ['count' => 3],
                cflt: ['count' => 0],
                ipflt: ['count' => 0],
                rule: ['count' => 0],
                svc: ['count' => 1],
                grp: ['count' => 0],
                opt: [
                    'count' => 0,
                    'data' => [],
                ],
                da: [],
            )
        ),
    ],
]);
