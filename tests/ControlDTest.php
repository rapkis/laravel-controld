<?php

declare(strict_types=1);

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\ControlD;
use Rapkis\Controld\Resources\Devices;
use Rapkis\Controld\Resources\Profiles;

it('accesses profiles resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->profiles())->toBeInstanceOf(Profiles::class);
});

it('accesses devices resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->devices())->toBeInstanceOf(Devices::class);
});
