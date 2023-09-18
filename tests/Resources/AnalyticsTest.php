<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Resources\Analytics;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists available analytics levels', function () {
    $request = Http::fake([
        'analytics/levels' => Http::response(mockJsonEndpoint('analytics-levels')),
    ])->asJson();

    $resource = new Analytics(
        $request,
    );

    $result = $resource->levels();

    expect($result)->toBeArray()
        ->and($result)->toHaveCount(3);
});

it('lists available analytics storage regions', function () {
    $request = Http::fake([
        'analytics/endpoints' => Http::response(mockJsonEndpoint('analytics-regions')),
    ])->asJson();

    $resource = new Analytics(
        $request,
    );

    $result = $resource->regions();

    expect($result)->toBeArray()
        ->and($result)->toHaveCount(3);
});
