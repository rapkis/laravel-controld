<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Factories\RuleFolderFactory;
use Rapkis\Controld\Resources\Profiles\RuleFolders;
use Rapkis\Controld\Responses\RuleFolder;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists profile rule folders', function () {
    $request = Http::fake([
        'profiles/profile_pk/groups' => Http::response(mockJsonEndpoint('profiles-rule-folders-list')),
    ])->asJson();

    $resource = new RuleFolders(
        $request,
        app(RuleFolderFactory::class),
    );

    $result = $resource->list('profile_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\RuleFolders::class)
        ->and($result)->toHaveCount(3);
});

it('creates a profile rule folder', function () {
    $request = Http::fake([
        'profiles/profile_pk/groups' => Http::response(mockJsonEndpoint('profiles-rule-folders-create')),
    ])->asJson();

    $resource = new RuleFolders(
        $request,
        app(RuleFolderFactory::class),
    );

    $result = $resource->create('profile_pk', 'name', new Action(true, 3, 'YYZ', null));

    expect($result)->toBeInstanceOf(RuleFolder::class);
});

it('modifies the rule folder', function () {
    $request = Http::fake([
        'profiles/profile_pk/groups/1' => Http::response(mockJsonEndpoint('profiles-rule-folders-modify')),
    ])->asJson();

    $resource = new RuleFolders(
        $request,
        app(RuleFolderFactory::class),
    );

    $result = $resource->modify('profile_pk', 1, 'name', new Action(true, 3, 'YYZ', null));

    expect($result)->toBeInstanceOf(RuleFolder::class);
});

it('deletes the rule folder', function () {
    $request = Http::fake([
        'profiles/profile_pk/groups/1' => Http::response(mockJsonEndpoint('profiles-rule-folders-modify')),
    ])->asJson();

    $resource = new RuleFolders(
        $request,
        $this->createStub(RuleFolderFactory::class),
    );

    $result = $resource->delete('profile_pk', 1);

    expect($result)->toBeTrue();
});
