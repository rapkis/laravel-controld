<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\ActionFactory;
use Rapkis\Controld\Resources\Profiles\DefaultRule;
use Rapkis\Controld\Responses\Action;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('shows default rule', function () {
    $request = Http::fake([
        'profiles/profile_pk/default' => Http::response(mockJsonEndpoint('profiles-default-rule-list')),
    ])->asJson();

    $resource = new DefaultRule(
        $request,
        app(ActionFactory::class),
    );

    $result = $resource->list('profile_pk');

    expect($result)->toBeInstanceOf(Action::class);
});

it('shows default rule missing', function () {
    $request = Http::fake([
        'profiles/profile_pk/default' => Http::response(mockJsonEndpoint('profiles-default-rule-empty')),
    ])->asJson();

    $resource = new DefaultRule(
        $request,
        $this->createStub(ActionFactory::class),
    );

    $result = $resource->list('profile_pk');

    expect($result)->toBeNull();
});

it('can modify profile option', function () {
    $request = Http::fake([
        'profiles/profile_pk/default' => Http::response(mockJsonEndpoint('profiles-default-rule-list')),
    ])->asJson();

    $resource = new DefaultRule(
        $request,
        app(ActionFactory::class),
    );

    $result = $resource->modify('profile_pk', new Action(true, 3, 'LOCAL', null));

    expect($result)->toBeInstanceOf(Action::class);
});
