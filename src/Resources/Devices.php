<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\DeviceFactory;
use Rapkis\Controld\Responses\Device;

class Devices
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly DeviceFactory $device,
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
        string $profilePk2 = null,
        int $stats = null,
        bool $legacyIpv4Status = false,
        bool $learnIp = false,
        bool $restricted = false,
        bool $bumpTls = false,
        string $description = null,
        int $ddnsStatus = null,
        string $ddnsSubdomain = null,
        int $ddnsExternalStatus = null,
        string $ddnsExternalHost = null,
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
}
