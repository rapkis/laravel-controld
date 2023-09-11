<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\DnsResolver;
use Rapkis\Controld\Entities\DynamicDns;
use Rapkis\Controld\Enums\DeviceAnalytics;
use Rapkis\Controld\Enums\DeviceStatus;
use Rapkis\Controld\Factories\DeviceFactory;
use Rapkis\Controld\Responses\Device;
use Rapkis\Controld\Responses\Profile;

it('builds a device', function (array $data, Device $expected) {
    expect((new DeviceFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'only_required_fields',
            'device_id' => 'only_required_fields',
            'ts' => 111111111,
            'name' => 'foo-device',
            'status' => 0, // pending
            'learn_ip' => 0,
            'resolvers' => [
                'uid' => 'resolver_id',
                'doh' => 'https://dns.controld.com/resolver_id',
                'dot' => 'resolver_id.dns.controld.com',
                'v6' => [
                    '2606:1a40::2',
                    '22606:1a40:1::2',
                ],
            ],
            'profile' => [
                'PK' => 'profile_pk',
                'updated' => 111111111,
                'name' => 'Foo Profile',
            ],
        ],
        new Device(
            pk: 'only_required_fields',
            deviceId: 'only_required_fields',
            timestamp: 111111111,
            name: 'foo-device',
            status: DeviceStatus::PENDING,
            learnIp: false,
            resolvers: [
                new DnsResolver('uid', ['resolver_id']),
                new DnsResolver('doh', ['https://dns.controld.com/resolver_id']),
                new DnsResolver('dot', ['resolver_id.dns.controld.com']),
                new DnsResolver('v6', [
                    '2606:1a40::2',
                    '22606:1a40:1::2',
                ]),
            ],
            profile: new Profile(
                pk: 'profile_pk',
                updated: 111111111,
                name: 'Foo Profile',
                disableTtl: null,
                stats: null,
                filters: null,
            ),
            profile2: null,
            description: '',
            stats: DeviceAnalytics::OFF,
            icon: null,
            dynamicDns: null,
            dynamicDnsExternal: null,
            legacyIpv4: null,
            lastActivity: null,
            restricted: false,
        ),
    ],
    [
        [
            'PK' => 'full_info',
            'device_id' => 'full_info',
            'ts' => 111111111,
            'name' => 'foo-device',
            'status' => 2, // soft disabled
            'learn_ip' => 0,
            'resolvers' => [
                'uid' => 'resolver_id',
                'doh' => 'https://dns.controld.com/resolver_id',
                'dot' => 'resolver_id.dns.controld.com',
                'v6' => [
                    '2606:1a40::2',
                    '22606:1a40:1::2',
                ],
            ],
            'profile' => [
                'PK' => 'profile_pk',
                'updated' => 111111111,
                'name' => 'Foo Profile',
            ],
            'profile2' => [
                'PK' => 'profile_2_pk',
                'updated' => 111111111,
                'name' => 'Bar Profile',
            ],
            'description' => 'my foo device',
            'stats' => 2, // full analytics
            'icon' => 'windows',
            'ddns' => [
                'status' => 1,
                'subdomain' => 'foo',
                'hostname' => 'foo.controld.live',
                'record' => '0.0.0.0',
            ],
            'ddns_ext' => [
                'status' => 1,
                'host' => 'foo.example.com',
            ],
            'legacy_ipv4' => [
                'resolver' => '1.1.1.1',
                'status' => 1,
            ],
            'last_activity' => 999999999,
            'restricted' => 1,
        ],
        new Device(
            pk: 'full_info',
            deviceId: 'full_info',
            timestamp: 111111111,
            name: 'foo-device',
            status: DeviceStatus::SOFT_DISABLED,
            learnIp: false,
            resolvers: [
                new DnsResolver('uid', ['resolver_id']),
                new DnsResolver('doh', ['https://dns.controld.com/resolver_id']),
                new DnsResolver('dot', ['resolver_id.dns.controld.com']),
                new DnsResolver('v6', [
                    '2606:1a40::2',
                    '22606:1a40:1::2',
                ]),
            ],
            profile: new Profile(
                pk: 'profile_pk',
                updated: 111111111,
                name: 'Foo Profile',
                disableTtl: null,
                stats: null,
                filters: null,
            ),
            profile2: new Profile(
                pk: 'profile_2_pk',
                updated: 111111111,
                name: 'Bar Profile',
                disableTtl: null,
                stats: null,
                filters: null,
            ),
            description: 'my foo device',
            stats: DeviceAnalytics::FULL,
            icon: 'windows',
            dynamicDns: new DynamicDns(
                status: true,
                hostname: 'foo.controld.live',
                subdomain: 'foo',
                record: '0.0.0.0',
            ),
            dynamicDnsExternal: new DynamicDns(
                status: true,
                hostname: 'foo.example.com',
                subdomain: null,
                record: null,
            ),
            legacyIpv4: new DnsResolver(
                type: 'legacy_ipv4',
                values: ['1.1.1.1'],
            ),
            lastActivity: 999999999,
            restricted: true,
        ),
    ],
]);
