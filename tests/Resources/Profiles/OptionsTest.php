<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\ProfileOptionFactory;
use Rapkis\Controld\Resources\Profiles\Options;
use Rapkis\Controld\Responses\ProfileOptions;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists profile options', function () {
    $request = Http::fake([
        'profiles/options' => Http::response(mockJsonEndpoint('profiles-list-options')),
    ])->asJson();

    $resource = new Options(
        $request,
        app(ProfileOptionFactory::class),
    );

    $result = $resource->list();

    expect($result)->toBeInstanceOf(ProfileOptions::class)
        ->and($result)->toHaveCount(9);
});

it('can modify profile option', function () {
    $request = Http::fake([
        'profiles/profile_pk/options/option_pk' => Http::response(mockJsonEndpoint('profiles-modify-options')),
    ])->asJson();

    $resource = new Options(
        $request,
        $this->createStub(ProfileOptionFactory::class),
    );

    expect($resource->modify('profile_pk', 'option_pk', true))->toBeTrue();
});
