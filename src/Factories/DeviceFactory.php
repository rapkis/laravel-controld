<?php

namespace Rapkis\Controld\Factories;

use Illuminate\Support\Arr;
use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\DnsResolver;
use Rapkis\Controld\Entities\DynamicDns;
use Rapkis\Controld\Enums\DeviceAnalytics;
use Rapkis\Controld\Enums\DeviceStatus;
use Rapkis\Controld\Responses\Device;

class DeviceFactory implements Factory
{
    public function make(array $data): Device
    {
        if (! empty($data['ddns'])) {
            $dynamicDns = $this->makeDynamicDns($data['ddns']);
        }

        if (! empty($data['ddns_ext'])) {
            $externalDns = $this->makeDynamicDns($data['ddns_ext']);
        }

        if (! empty($data['legacy_ipv4']) && $data['legacy_ipv4']['status'] === 1) {
            $legacyIpv4 = new DnsResolver(
                type: 'legacy_ipv4',
                values: Arr::wrap($data['legacy_ipv4']['resolver']),
            );
        }

        return new Device(
            pk: $data['PK'],
            deviceId: $data['device_id'],
            timestamp: $data['ts'],
            name: $data['name'],
            status: DeviceStatus::from((int) $data['status']),
            learnIp: (bool) $data['learn_ip'],
            resolvers: $this->makeResolvers($data['resolvers']),
            profile: (new ProfileFactory())->make($data['profile']),
            profile2: ! empty($data['profile2']) ? (new ProfileFactory())->make($data['profile2']) : null,
            description: $data['description'] ?? '',
            stats: DeviceAnalytics::tryFrom($data['stats'] ?? null),
            icon: $data['icon'] ?? null,
            dynamicDns: $dynamicDns ?? null,
            dynamicDnsExternal: $externalDns ?? null,
            legacyIpv4: $legacyIpv4 ?? null,
            lastActivity: $data['last_activity'] ?? $data['activity'] ?? null,
            restricted: (bool) ($data['restricted'] ?? false),
        );
    }

    private function makeResolvers(array $resolvers): array
    {
        $result = [];

        foreach ($resolvers as $name => $resolver) {
            $result[] = new DnsResolver(
                type: $name,
                values: Arr::wrap($resolver)
            );
        }

        return $result;
    }

    private function makeDynamicDns(array $ddns): DynamicDns
    {
        return new DynamicDns(
            status: (bool) $ddns['status'],
            hostname: $ddns['hostname'] ?? $ddns['host'],
            subdomain: $ddns['subdomain'] ?? null,
            record: $ddns['record'] ?? null,
        );
    }
}
