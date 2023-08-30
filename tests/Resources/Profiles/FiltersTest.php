<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\FilterFactory;
use Rapkis\Controld\Resources\Profiles\Filters;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists native profile filters', function () {
    $request = Http::fake([
        'profiles/profile_pk/filters' => Http::response(mockJsonEndpoint('profiles-filters-list-native')),
    ])->asJson();

    $resource = new Filters(
        $request,
        app(FilterFactory::class),
    );

    $result = $resource->native('profile_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Filters::class)
        ->and($result)->toHaveCount(18);
});

it('lists third party profile filters', function () {
    $request = Http::fake([
        'profiles/profile_pk/filters/external' => Http::response(mockJsonEndpoint('profiles-filters-list-third-party')),
    ])->asJson();

    $resource = new Filters(
        $request,
        app(FilterFactory::class),
    );

    $result = $resource->thirdParty('profile_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Filters::class)
        ->and($result)->toHaveCount(14);
});

it('modifies a filter for a profile', function () {
    $request = Http::fake([
        'profiles/profile_pk/filters/filter/ads' => Http::response(mockJsonEndpoint('profiles-filters-modify')),
    ])->asJson();

    $resource = new Filters(
        $request,
        $this->createStub(FilterFactory::class),
    );

    $result = $resource->modify('profile_pk', 'ads', true);

    expect($result)->toHaveCount(3)
        ->and($result[0])->toEqual('ads')
        ->and($result[1])->toEqual('iot')
        ->and($result[2])->toEqual('malware');
});
