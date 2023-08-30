<?php

declare(strict_types=1);

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\ProfileFactory;
use Rapkis\Controld\Resources\Profiles;
use Rapkis\Controld\Responses\Profile;
use Rapkis\Controld\Responses\ProfileList;

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
    );

    $result = $resource->delete('123foobar');

    expect($result)->toBeTrue();
});

it('accesses options', function () {
    $resource = new Profiles(
        $this->createStub(PendingRequest::class),
        $this->createStub(ProfileFactory::class),
    );

    expect($resource->options())->toBeInstanceOf(Profiles\Options::class);
});

it('accesses filters', function () {
    $resource = new Profiles(
        $this->createStub(PendingRequest::class),
        $this->createStub(ProfileFactory::class),
    );

    expect($resource->filters())->toBeInstanceOf(Profiles\Filters::class);
});

it('accesses services', function () {
    $resource = new Profiles(
        $this->createStub(PendingRequest::class),
        $this->createStub(ProfileFactory::class),
    );

    expect($resource->services())->toBeInstanceOf(Profiles\Services::class);
});
