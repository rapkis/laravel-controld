<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\UserDataFactory;
use Rapkis\Controld\Resources\Account;
use Rapkis\Controld\Responses\UserData;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('gets user data', function () {
    $request = Http::fake([
        'users' => Http::response(mockJsonEndpoint('account-user-data')),
    ])->asJson();

    $resource = new Account(
        $request,
        app(UserDataFactory::class),
    );

    $result = $resource->users();

    expect($result)->toBeInstanceOf(UserData::class);
});
