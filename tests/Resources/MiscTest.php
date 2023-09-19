<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\DatacenterIpFactory;
use Rapkis\Controld\Factories\NetworkFactory;
use Rapkis\Controld\Resources\Misc;
use Rapkis\Controld\Responses\DatacenterIp;
use Rapkis\Controld\Responses\Networks;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('shows datacenter ip', function () {
    $request = Http::fake([
        'ip' => Http::response(mockJsonEndpoint('misc-ip')),
    ])->asJson();

    $resource = new Misc(
        $request,
        app(DatacenterIpFactory::class),
        $this->createStub(NetworkFactory::class),
    );

    $result = $resource->ip();

    expect($result)->toBeInstanceOf(DatacenterIp::class);
});

it('lists network statuses', function () {
    $request = Http::fake([
        'network' => Http::response(mockJsonEndpoint('misc-network')),
    ])->asJson();

    $resource = new Misc(
        $request,
        $this->createStub(DatacenterIpFactory::class),
        app(NetworkFactory::class),
    );

    $result = $resource->networkStats();

    expect($result)->toBeInstanceOf(Networks::class)
        ->and($result)->toHaveCount(5)
        ->and($result->time)->toBe(1695135064)
        ->and($result->currentPop)->toBe('IAD');
});
