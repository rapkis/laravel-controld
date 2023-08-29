<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Responses\Profile;
use Rapkis\Controld\Factories\ProfileFactory;
use Rapkis\Controld\Factories\ProfileOptionFactory;
use Rapkis\Controld\Resources\Profiles;
use Rapkis\Controld\Responses\ProfileList;
use Rapkis\Controld\Responses\ProfileOptions;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists profiles', function () {
    $request = Http::fake([
        'profiles' => Http::response(mockJsonEndpoint('profiles-list')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        app(ProfileFactory::class),
        $this->createStub(ProfileOptionFactory::class),
    );

    $result = $resource->list();

    expect($result)->toBeInstanceOf(ProfileList::class)
        ->and($result)->toHaveCount(2);
});

it('creates a profile', function () {
    $request = Http::fake([
        'profiles' => Http::response(mockJsonEndpoint('profiles-create')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        app(ProfileFactory::class),
        $this->createStub(ProfileOptionFactory::class),
    );

    $result = $resource->create('Test name');

    expect($result)->toBeInstanceOf(Profile::class);
});

it('modifies a profile', function () {
    $request = Http::fake([
        'profiles/123foobar' => Http::response(mockJsonEndpoint('profiles-modify')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        app(ProfileFactory::class),
        $this->createStub(ProfileOptionFactory::class),
    );

    $result = $resource->modify('123foobar');

    expect($result)->toBeInstanceOf(Profile::class);
});

it('deletes a profile', function () {
    $request = Http::fake([
        'profiles/123foobar' => Http::response(mockJsonEndpoint('profiles-delete')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        app(ProfileFactory::class),
        $this->createStub(ProfileOptionFactory::class),
    );

    $result = $resource->delete('123foobar');

    expect($result)->toBeTrue();
});

it('lists profile options', function () {
    $request = Http::fake([
        'profiles/options' => Http::response(mockJsonEndpoint('profiles-list-options')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        $this->createStub(ProfileFactory::class),
        app(ProfileOptionFactory::class),
    );

    $result = $resource->options();

    expect($result)->toBeInstanceOf(ProfileOptions::class)
        ->and($result)->toHaveCount(9);
});

it('can modify profile option', function () {
    $request = Http::fake([
        'profiles/profile_pk/options/option_pk' => Http::response(mockJsonEndpoint('profiles-modify-options')),
    ])->asJson();

    $resource = new Profiles(
        $request,
        $this->createStub(ProfileFactory::class),
        $this->createStub(ProfileOptionFactory::class),
    );

    expect($resource->modifyOption('profile_pk', 'option_pk', true))->toBeTrue();
});
