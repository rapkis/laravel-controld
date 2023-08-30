<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\Service;
use Rapkis\Controld\Entities\ServiceAction;
use Rapkis\Controld\Factories\ServiceFactory;

it('builds a service', function (array $data, Service $expected) {
    expect((new ServiceFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'no_action',
            'category' => 'tools',
            'name' => 'No action from List All Services endpoint',
            'unlock_location' => 'JFK',
        ],
        new Service(
            pk: 'no_action',
            category: 'tools',
            name: 'No action from List All Services endpoint',
            unlockLocation: 'JFK',
            locations: [],
            warning: null,
            action: null,
        ),
    ],
    [
        [
            'PK' => 'block_disabled',
            'category' => 'social',
            'name' => 'Facebook',
            'unlock_location' => 'JFK',
            'locations' => [],
            'warning' => 'foo',
            'action' => [
                'do' => 0,
                'status' => 0,
            ],
        ],
        new Service(
            pk: 'block_disabled',
            category: 'social',
            name: 'Facebook',
            unlockLocation: 'JFK',
            locations: [],
            warning: 'foo',
            action: new ServiceAction(
                do: 0,
                status: false,
                via: null,
            ),
        ),
    ],
    [
        [
            'PK' => 'bypass_enabled',
            'category' => '',
            'name' => '',
            'unlock_location' => 'JFK',
            'locations' => [],
            'action' => [
                'do' => 1,
                'status' => 1,
            ],
        ],
        new Service(
            pk: 'bypass_enabled',
            category: '',
            name: '',
            unlockLocation: 'JFK',
            locations: [],
            warning: null,
            action: new ServiceAction(
                do: 1,
                status: true,
                via: null,
            ),
        ),
    ],
    [
        [
            'PK' => 'spoof',
            'category' => '',
            'name' => '',
            'unlock_location' => 'JFK',
            'locations' => [],
            'action' => [
                'do' => 2,
                'status' => 0,
            ],
        ],
        new Service(
            pk: 'spoof',
            category: '',
            name: '',
            unlockLocation: 'JFK',
            locations: [],
            warning: null,
            action: new ServiceAction(
                do: 2,
                status: false,
                via: null,
            ),
        ),
    ],
    [
        [
            'PK' => 'redirect_proxy',
            'category' => '',
            'name' => '',
            'unlock_location' => 'JFK',
            'locations' => ['FOO', 'BAR'],
            'action' => [
                'do' => 3,
                'status' => 0,
                'via' => 'CITY',
            ],
        ],
        new Service(
            pk: 'redirect_proxy',
            category: '',
            name: '',
            unlockLocation: 'JFK',
            locations: ['FOO', 'BAR'],
            warning: null,
            action: new ServiceAction(
                do: 3,
                status: false,
                via: 'CITY',
            ),
        ),
    ],
]);
