<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Factories\CustomRuleFactory;
use Rapkis\Controld\Resources\Profiles\CustomRules;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists custom rules', function () {
    $request = Http::fake([
        'profiles/profile_pk/rules/all' => Http::response(mockJsonEndpoint('profiles-custom-rules-list')),
    ])->asJson();

    $resource = new CustomRules(
        $request,
        app(CustomRuleFactory::class),
    );

    $result = $resource->list('profile_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\CustomRules::class)
        ->and($result)->toHaveCount(3);
});

it('creates a custom rule', function () {
    $request = Http::fake([
        'profiles/profile_pk/rules' => Http::response(mockJsonEndpoint('profiles-custom-rules-create')),
    ])->asJson();

    $resource = new CustomRules(
        $request,
        app(CustomRuleFactory::class),
    );

    $result = $resource->create('profile_pk', 0, ['foo.bar', 'bar.foo'], new Action(true, 2, '127.0.0.1', null));

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\CustomRules::class)
        ->and($result)->toHaveCount(2)
        ->and($result->first()->action)->toEqual(new Action(true, 2, '127.0.0.1', null));
});

it('modifies the custom rule', function () {
    $request = Http::fake([
        'profiles/profile_pk/rules' => Http::response(mockJsonEndpoint('profiles-custom-rules-modify')),
    ])->asJson();

    $resource = new CustomRules(
        $request,
        app(CustomRuleFactory::class),
    );

    $result = $resource->modify('profile_pk', 0, ['foo.bar', 'bar.foo'], new Action(false, 2, '127.0.0.1', null));

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\CustomRules::class)
        ->and($result)->toHaveCount(2)
        ->and($result->first()->action)->toEqual(new Action(false, 2, '127.0.0.1', null));
});

it('deletes the custom rule', function () {
    $request = Http::fake([
        'profiles/profile_pk/rules/foo.bar' => Http::response(mockJsonEndpoint('profiles-rule-folders-modify')),
    ])->asJson();

    $resource = new CustomRules(
        $request,
        $this->createStub(CustomRuleFactory::class),
    );

    $result = $resource->delete('profile_pk', 'foo.bar');

    expect($result)->toBeTrue();
});
