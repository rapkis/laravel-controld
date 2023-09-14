<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\LearnedIpFactory;
use Rapkis\Controld\Resources\Access;
use Rapkis\Controld\Responses\LearnedIps;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists known ips', function () {
    $request = Http::fake([
        'access?device_id=device_pk' => Http::response(mockJsonEndpoint('access-list')),
    ])->asJson();

    $resource = new Access(
        $request,
        app(LearnedIpFactory::class),
    );

    $result = $resource->list('device_pk');

    expect($result)->toBeInstanceOf(LearnedIps::class)
        ->and($result)->toHaveCount(3);
});

it('learns a new ip', function () {
    $request = Http::fake([
        'access' => Http::response(mockJsonEndpoint('access-learn')),
    ])->asJson();

    $resource = new Access(
        $request,
        $this->createStub(LearnedIpFactory::class),
    );

    $result = $resource->learn('device_pk', ['0.0.0.0']);

    expect($result)->toBeTrue();
});

it('deletes an IP', function () {
    $request = Http::fake([
        'access' => Http::response(mockJsonEndpoint('access-delete')),
    ])->asJson();

    $resource = new Access(
        $request,
        $this->createStub(LearnedIpFactory::class),
    );

    $result = $resource->delete('device_pk', ['0.0.0.0']);

    expect($result)->toBeTrue();
});
