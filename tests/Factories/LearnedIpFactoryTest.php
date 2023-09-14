<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\LearnedIp;
use Rapkis\Controld\Factories\LearnedIpFactory;

it('builds an action', function (array $data, LearnedIp $expected) {
    expect((new LearnedIpFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'ip' => '127.0.0.1',
            'ts' => 111111111,
            'country' => null,
            'city' => null,
            'isp' => 'Cloudflare',
        ],
        new LearnedIp(
            ip: '127.0.0.1',
            timestamp: 111111111,
            isp: 'Cloudflare',
            country: null,
            city: null,
        ),
    ],
    [
        [
            'ip' => '2606:1a40::2',
            'ts' => 111111111,
            'country' => 'US',
            'city' => 'New York',
            'isp' => 'Cloudflare',
        ],
        new LearnedIp(
            ip: '2606:1a40::2',
            timestamp: 111111111,
            isp: 'Cloudflare',
            country: 'US',
            city: 'New York',
        ),
    ],
]);
