<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\DnsResolver;
use Rapkis\Controld\Entities\Filter;
use Rapkis\Controld\Entities\FilterOption;
use Rapkis\Controld\Factories\FilterFactory;

it('builds a filter', function (array $data, Filter $expected) {
    expect((new FilterFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'basic_disabled',
            'name' => 'Simple Example Filter',
            'description' => 'Description',
            'additional' => '<p>HTML</p>',
            'sources' => [],
            'status' => 0,
        ],
        new Filter(
            pk: 'basic_disabled',
            name: 'Simple Example Filter',
            description: 'Description',
            additional: '<p>HTML</p>',
            sources: [],
            options: [],
            resolvers: [],
            status: false,
        ),
    ],
    [
        [
            'PK' => 'basic_enabled',
            'name' => 'Simple Example Filter',
            'description' => 'Description',
            'additional' => '<p>HTML</p>',
            'sources' => [],
            'status' => 1,
        ],
        new Filter(
            pk: 'basic_enabled',
            name: 'Simple Example Filter',
            description: 'Description',
            additional: '<p>HTML</p>',
            sources: [],
            options: [],
            resolvers: [],
            status: true,
        ),
    ],
    [
        [
            'PK' => 'no_additional_info',
            'name' => '',
            'description' => '',
            'sources' => [],
            'status' => 1,
        ],
        new Filter(
            pk: 'no_additional_info',
            name: '',
            description: '',
            additional: '',
            sources: [],
            options: [],
            resolvers: [],
            status: true,
        ),
    ],
    [
        [
            'PK' => 'with_options',
            'name' => '',
            'description' => '',
            'sources' => [],
            'options' => [
                [
                    'title' => 'Option Foo',
                    'description' => 'Option Foo description',
                    'type' => 'optiontypefilter',
                    'name' => 'option_foo',
                    'status' => 0,
                ],
                [
                    'title' => 'Option Bar',
                    'description' => 'Option Bar description',
                    'type' => 'optiontypefilter',
                    'name' => 'option_bar',
                    'status' => 1,
                ],
            ],
            'status' => 0,
        ],
        new Filter(
            pk: 'with_options',
            name: '',
            description: '',
            additional: '',
            sources: [],
            options: [
                'option_foo' => new FilterOption(
                    title: 'Option Foo',
                    description: 'Option Foo description',
                    type: 'optiontypefilter',
                    name: 'option_foo',
                    status: false,
                ),
                'option_bar' => new FilterOption(
                    title: 'Option Bar',
                    description: 'Option Bar description',
                    type: 'optiontypefilter',
                    name: 'option_bar',
                    status: true,
                ),
            ],
            resolvers: [],
            status: false,
        ),
    ],
    [
        [
            'PK' => 'with_resolvers',
            'name' => '',
            'description' => '',
            'sources' => [],
            'resolvers' => [
                'v4' => [
                    '76.76.2.2',
                    '76.76.10.2',
                ],
                'v6' => [
                    '2606:1a40::2',
                    '22606:1a40:1::2',
                ],
                'DoH' => ['https://freedns.controld.com/p2'],
                'DoT' => ['p2.freedns.controld.com'],
            ],
            'status' => 1,
        ],
        new Filter(
            pk: 'with_resolvers',
            name: '',
            description: '',
            additional: '',
            sources: [],
            options: [],
            resolvers: [
                'v4' => new DnsResolver(
                    type: 'v4',
                    values: [
                        '76.76.2.2',
                        '76.76.10.2',
                    ],
                ),
                'v6' => new DnsResolver(
                    type: 'v6',
                    values: [
                        '2606:1a40::2',
                        '22606:1a40:1::2',
                    ],
                ),
                'DoH' => new DnsResolver(
                    type: 'DoH',
                    values: ['https://freedns.controld.com/p2'],
                ),
                'DoT' => new DnsResolver(
                    type: 'DoT',
                    values: ['p2.freedns.controld.com'],
                ),
            ],
            status: true,
        ),
    ],
    [
        [
            'PK' => 'with_sources',
            'name' => '',
            'description' => '',
            'sources' => ['https://example.com'],
            'status' => 1,
        ],
        new Filter(
            pk: 'with_sources',
            name: '',
            description: '',
            additional: '',
            sources: ['https://example.com'],
            options: [],
            resolvers: [],
            status: true,
        ),
    ],
]);
