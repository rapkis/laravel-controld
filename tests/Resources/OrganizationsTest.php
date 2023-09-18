<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\MemberFactory;
use Rapkis\Controld\Factories\OrganizationFactory;
use Rapkis\Controld\Resources\Organizations;
use Rapkis\Controld\Responses\Members;
use Rapkis\Controld\Responses\Organization;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('shows organization', function () {
    $request = Http::fake([
        'organizations/organization' => Http::response(mockJsonEndpoint('organizations-organization')),
    ])->asJson();

    $resource = new Organizations(
        $request,
        app(OrganizationFactory::class),
        $this->createStub(MemberFactory::class),
    );

    $result = $resource->organization();

    expect($result)->toBeInstanceOf(Organization::class);
});

it('lists organization members', function () {
    $request = Http::fake([
        'organizations/members' => Http::response(mockJsonEndpoint('organizations-members')),
    ])->asJson();

    $resource = new Organizations(
        $request,
        $this->createStub(OrganizationFactory::class),
        app(MemberFactory::class),
    );

    $result = $resource->members();

    expect($result)->toBeInstanceOf(Members::class)
        ->and($result)->toHaveCount(2);
});

it('lists sub-organizations', function () {
    $request = Http::fake([
        'organizations/sub_organizations' => Http::response(mockJsonEndpoint('organizations-suborganizations')),
    ])->asJson();

    $resource = new Organizations(
        $request,
        app(OrganizationFactory::class),
        $this->createStub(MemberFactory::class),
    );

    $result = $resource->subOrganizations();

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Organizations::class)
        ->and($result)->toHaveCount(3);
});
