<?php

declare(strict_types=1);

use Rapkis\Controld\Factories\ActionFactory;
use Rapkis\Controld\Responses\Action;

it('builds an action', function (array $data, Action $expected) {
    expect((new ActionFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'status' => 0,
            'do' => 2,
            'via' => '127.0.0.1',
            'ttl' => 12345678,
        ],
        new Action(
            status: false,
            do: 2,
            via: '127.0.0.1',
            ttl: 12345678,
        ),
    ],
    [
        [
            'status' => 1,
        ],
        new Action(
            status: true,
            do: null,
            via: null,
            ttl: null,
        ),
    ],
]);
