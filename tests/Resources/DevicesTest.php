<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\DeviceFactory;
use Rapkis\Controld\Factories\DeviceTypeFactory;
use Rapkis\Controld\Resources\Devices;
use Rapkis\Controld\Responses\Device;
use Rapkis\Controld\Responses\DeviceTypes;

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
        $this->createStub(DeviceTypeFactory::class),
    );

    $result = $resource->list();

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Devices::class)
        ->and($result)->toHaveCount(3);
});

it('creates a device', function () {
    $request = Http::fake([
        'devices' => Http::response(mockJsonEndpoint('devices-create')),
    ])->asJson();

    $resource = new Devices(
        $request,
        app(DeviceFactory::class),
        $this->createStub(DeviceTypeFactory::class),
    );

    $result = $resource->create('device_name', 'profile_pk', 'icon');

    expect($result)->toBeInstanceOf(Device::class);
});

it('lists device types', function () {
    $request = Http::fake([
        'devices/types' => Http::response(mockJsonEndpoint('devices-types-list')),
    ])->asJson();

    $resource = new Devices(
        $request,
        app(DeviceFactory::class),
        app(DeviceTypeFactory::class),
    );

    $result = $resource->types();

    expect($result)->toBeInstanceOf(DeviceTypes::class)
        ->and($result)->toHaveCount(4);
});
