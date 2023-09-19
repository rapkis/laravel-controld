<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Resources\MobileConfig;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('displays mobile config', function () {
    $dummyBinary = file_get_contents(__DIR__.'/../Mocks/Endpoints/mobile-config.bin');

    $request = Http::fake([
        'mobileconfig/device_pk?dont_sign=0&exclude_common=0' => Http::response($dummyBinary),
    ])->asJson();

    $resource = new MobileConfig($request);

    $result = $resource->generateProfile('device_pk');

    expect($result)->toBe($dummyBinary);
});
