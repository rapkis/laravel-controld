<?php

declare(strict_types=1);

use Rapkis\Controld\Factories\ProxyFactory;
use Rapkis\Controld\Resources\Profiles\Proxies;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists proxies', function () {
    $request = Http::fake([
        'proxies' => Http::response(mockJsonEndpoint('profiles-list-proxies')),
    ])->asJson();

    $resource = new Proxies(
        $request,
        app(ProxyFactory::class),
    );

    $result = $resource->list();

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Proxies::class)
        ->and($result)->toHaveCount(106);
});
