<?php

declare(strict_types=1);

use Rapkis\Controld\Factories\CustomRuleFactory;
use Rapkis\Controld\Responses\Action;
use Rapkis\Controld\Responses\CustomRule;

it('builds a custom rule', function (array $data, CustomRule $expected) {
    expect((new CustomRuleFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'test.com',
            'order' => 1,
            'group' => 1,
            'action' => [
                'do' => 0,
                'status' => 0,
                'ttl' => 1693515600,
            ],
        ],
        new CustomRule(
            pk: 'test.com',
            order: 1,
            group: 1,
            action: new Action(
                status: false,
                do: 0,
                via: null,
                ttl: 1693515600,
            ),
        ),
    ],
    [
        [
            'PK' => 'foo.bar',
            'order' => 2,
            'group' => 1,
            'action' => [
                'do' => 0,
                'status' => 1,
            ],
        ],
        new CustomRule(
            pk: 'foo.bar',
            order: 2,
            group: 1,
            action: new Action(
                status: true,
                do: 0,
                via: null,
                ttl: null,
            ),
        ),
    ],
    [
        [
            'PK' => 'derp123.com',
            'order' => 12,
            'group' => 0,
            'action' => [
                'do' => 2,
                'via' => '1.2.3.4',
                'status' => 1,
            ],
        ],
        new CustomRule(
            pk: 'derp123.com',
            order: 12,
            group: 0,
            action: new Action(
                status: true,
                do: 2,
                via: '1.2.3.4',
                ttl: null,
            ),
        ),
    ],
]);
