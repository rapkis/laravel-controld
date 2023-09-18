<?php

declare(strict_types=1);

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\ControlD;
use Rapkis\Controld\Resources\Access;
use Rapkis\Controld\Resources\Account;
use Rapkis\Controld\Resources\Analytics;
use Rapkis\Controld\Resources\Devices;
use Rapkis\Controld\Resources\Organizations;
use Rapkis\Controld\Resources\Profiles;
use Rapkis\Controld\Resources\Services;

it('accesses profiles resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->profiles())->toBeInstanceOf(Profiles::class);
});

it('accesses devices resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->devices())->toBeInstanceOf(Devices::class);
});

it('accesses access resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->access())->toBeInstanceOf(Access::class);
});

it('accesses services resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->services())->toBeInstanceOf(Services::class);
});

it('accesses analytics resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->analytics())->toBeInstanceOf(Analytics::class);
});

it('accesses account resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->account())->toBeInstanceOf(Account::class);
});

it('accesses organizations resource', function () {
    $client = new ControlD($this->createStub(PendingRequest::class));
    expect($client->organizations())->toBeInstanceOf(Organizations::class);
});
