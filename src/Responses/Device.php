<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use Rapkis\Controld\Entities\DnsResolver;
use Rapkis\Controld\Entities\DynamicDns;
use Rapkis\Controld\Enums\DeviceAnalytics;
use Rapkis\Controld\Enums\DeviceStatus;

class Device
{
    /**
     * @param  array<DnsResolver>  $resolvers
     */
    public function __construct(
        public readonly string $pk,
        public readonly string $deviceId,
        public readonly int $timestamp,
        public readonly string $name,
        public readonly DeviceStatus $status,
        public readonly bool $learnIp,
        public readonly array $resolvers,
        public readonly Profile $profile,
        public readonly string $description,
        public readonly DeviceAnalytics $stats,
        public readonly ?string $icon,
        public readonly ?DynamicDns $dynamicDns,
        public readonly ?DynamicDns $dynamicDnsExternal,
        public readonly ?DnsResolver $legacyIpv4,
        public readonly ?int $lastActivity,
        public readonly bool $restricted,
    ) {
    }
}
