<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\DeviceType;
use Rapkis\Controld\Factories\DeviceTypeFactory;

it('builds a device type', function (array $data, DeviceType $expected) {
    expect((new DeviceTypeFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'type' => 'os',
            'name' => 'Desktop & Mobile',
            'icons' => [
                'desktop-windows' => 'Windows',
                'desktop-mac' => 'Mac',
                'desktop-linux' => 'Linux',
                'mobile-ios' => 'iOS',
                'mobile-android' => 'Android',
            ],
        ],
        new DeviceType(
            type: 'os',
            name: 'Desktop & Mobile',
            icons: [
                'desktop-windows' => 'Windows',
                'desktop-mac' => 'Mac',
                'desktop-linux' => 'Linux',
                'mobile-ios' => 'iOS',
                'mobile-android' => 'Android',
            ],
            setupUrl: null,
        ),
    ],
    [
        [
            'type' => 'router',
            'name' => 'Routers',
            'icons' => [
                'router-openwrt' => 'OpenWRT',
                'router-ubiquiti' => 'Ubiquiti',
                'router-asus' => 'Asus',
                'router-ddwrt' => 'DD-WRT',
                'router' => 'Other',
            ],
            'setup_url' => 'https://github.com/Control-D-Inc/ctrld',
        ],
        new DeviceType(
            type: 'router',
            name: 'Routers',
            icons: [
                'router-openwrt' => 'OpenWRT',
                'router-ubiquiti' => 'Ubiquiti',
                'router-asus' => 'Asus',
                'router-ddwrt' => 'DD-WRT',
                'router' => 'Other',
            ],
            setupUrl: 'https://github.com/Control-D-Inc/ctrld',
        ),
    ],
]);
