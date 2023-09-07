<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\DeviceFactory;
use Rapkis\Controld\Resources\Devices;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists devices', function () {
    $request = Http::fake([
        'devices' => Http::response(mockJsonEndpoint('devices-list')),
    ])->asJson();

    $resource = new Devices(
        $request,
        app(DeviceFactory::class),
    );

    $result = $resource->list();

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Devices::class)
        ->and($result)->toHaveCount(3);
});
