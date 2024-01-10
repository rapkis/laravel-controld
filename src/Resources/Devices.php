<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Enums\DeviceStatus;
use Rapkis\Controld\Factories\DeviceFactory;
use Rapkis\Controld\Factories\DeviceTypeFactory;
use Rapkis\Controld\Responses\Device;
use Rapkis\Controld\Responses\DeviceTypes;

class Devices
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly DeviceFactory $device,
        private readonly DeviceTypeFactory $deviceType,
    ) {
    }

    public function list(): \Rapkis\Controld\Responses\Devices
    {
        $response = $this->client->get('devices')->json('body.devices');
        $result = new \Rapkis\Controld\Responses\Devices();

        foreach ($response as $device) {
            $device = $this->device->make($device);
            $result->put($device->pk, $device);
        }

        return $result;
    }

    public function create(
        string $name,
        string $profilePk,
        string $icon,
        ?string $profilePk2 = null,
        ?int $stats = null,
        bool $legacyIpv4Status = false,
        bool $learnIp = false,
        bool $restricted = false,
        bool $bumpTls = false,
        ?string $description = null,
        ?int $ddnsStatus = null,
        ?string $ddnsSubdomain = null,
        ?int $ddnsExternalStatus = null,
        ?string $ddnsExternalHost = null,
    ): Device {
        $response = $this->client->post('devices', [
            'name' => $name,
            'profile_id' => $profilePk,
            'profile_id2' => $profilePk2,
            'icon' => $icon,
            'stats' => $stats,
            'legacy_ipv4_status' => (int) $legacyIpv4Status,
            'learn_ip' => (int) $learnIp,
            'restricted' => (int) $restricted,
            'bump_tls' => (int) $bumpTls,
            'desc' => $description,
            'ddns_status' => $ddnsStatus,
            'ddns_subdomain' => $ddnsSubdomain,
            'ddns_ext_status' => $ddnsExternalStatus,
            'ddns_ext_host' => $ddnsExternalHost,
        ])->json('body');

        return $this->device->make($response);
    }

    public function types(): DeviceTypes
    {
        $response = $this->client->get('devices/types')->json('body.types');

        $result = new DeviceTypes();

        foreach ($response as $type => $deviceType) {
            $deviceType['type'] = $type;
            $deviceType = $this->deviceType->make($deviceType);
            $result->put($deviceType->type, $deviceType);
        }

        return $result;
    }

    public function analyticsLevels(): array
    {
        return $this->client->get('devices/stat_levels')->json('body.stat_levels');
    }

    public function modify(
        string $devicePk,
        ?string $name = null,
        ?string $profilePk = null,
        ?string $icon = null,
        ?string $profilePk2 = null,
        ?int $stats = null,
        ?bool $legacyIpv4Status = null,
        ?bool $learnIp = null,
        ?bool $restricted = null,
        ?bool $bumpTls = null,
        ?string $description = null,
        ?int $ddnsStatus = null,
        ?string $ddnsSubdomain = null,
        ?int $ddnsExternalStatus = null,
        ?string $ddnsExternalHost = null,
        ?DeviceStatus $status = null,
        ?string $ctrldCustomConfig = null,
    ): Device {
        $response = $this->client->put("devices/{$devicePk}", [
            'name' => $name,
            'profile_id' => $profilePk,
            'profile_id2' => $profilePk2,
            'icon' => $icon,
            'stats' => $stats,
            'legacy_ipv4_status' => ! is_null($legacyIpv4Status) ? (int) $legacyIpv4Status : $legacyIpv4Status,
            'learn_ip' => ! is_null($learnIp) ? (int) $learnIp : $learnIp,
            'restricted' => ! is_null($restricted) ? (int) $restricted : $restricted,
            'bump_tls' => ! is_null($bumpTls) ? (int) $bumpTls : $bumpTls,
            'desc' => $description,
            'ddns_status' => $ddnsStatus,
            'ddns_subdomain' => $ddnsSubdomain,
            'ddns_ext_status' => $ddnsExternalStatus,
            'ddns_ext_host' => $ddnsExternalHost,
            'status' => $status?->value,
            'ctrld_custom_config' => $ctrldCustomConfig,
        ])->json('body');

        return $this->device->make($response);
    }

    public function delete(string $devicePk): bool
    {
        $this->client->delete("devices/{$devicePk}");

        return true;
    }
}
