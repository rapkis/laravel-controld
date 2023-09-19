<?php

declare(strict_types=1);

use Rapkis\Controld\Factories\DatacenterIpFactory;
use Rapkis\Controld\Responses\DatacenterIp;

it('builds a data center ip', function (array $data, DatacenterIp $expected) {
    expect((new DatacenterIpFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'ip' => '66.207.0.0',
            'type' => 'v4',
            'org' => 'Beanfield Technologies',
            'country' => 'CA',
            'handler' => 'dva-h01',
        ],
        new DatacenterIp(
            ip: '66.207.0.0',
            type: 'v4',
            organization: 'Beanfield Technologies',
            country: 'CA',
            handler: 'dva-h01',
        ),
    ],
]);
