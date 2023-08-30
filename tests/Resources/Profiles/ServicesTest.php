<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Entities\ServiceAction;
use Rapkis\Controld\Factories\ServiceFactory;
use Rapkis\Controld\Resources\Profiles\Services;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists profile services', function () {
    $request = Http::fake([
        'profiles/profile_pk/services' => Http::response(mockJsonEndpoint('profiles-services-list')),
    ])->asJson();

    $resource = new Services(
        $request,
        app(ServiceFactory::class),
    );

    $result = $resource->list('profile_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Services::class)
        ->and($result)->toHaveCount(4);
});

it('modifies a service for a profile', function () {
    $request = Http::fake([
        'profiles/profile_pk/services/service' => Http::response(mockJsonEndpoint('profiles-services-modify')),
    ])->asJson();

    $resource = new Services(
        $request,
        $this->createStub(ServiceFactory::class),
    );

    $result = $resource->modify('profile_pk', 'service', new ServiceAction(
        do: 0,
        status: true,
        via: null,
    ));

    expect($result)->toBeTrue();
});
