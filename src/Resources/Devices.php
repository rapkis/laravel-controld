<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\DeviceFactory;

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
}
