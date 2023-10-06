<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Rapkis\Controld\Entities\OrganizationLimit;
use Rapkis\Controld\Factories\OrganizationFactory;
use Rapkis\Controld\Responses\Organization;
use Rapkis\Controld\Responses\Profile;

it('builds a organization', function (array $data, Organization $expected) {
    expect((new OrganizationFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'website' => 'example.com',
            'address' => '123 Totally Real St, Toronto',
            'max_profiles' => 100,
            'status' => 1,
            'max_users' => 400,
            'max_legacy_resolvers' => 10,
            'name' => 'Main Inc',
            'price_users' => 2,
            'date' => '2000-01-01',
            'max_routers' => 10,
            'price_routers' => 10,
            'max_sub_orgs' => 5,
            'contact_email' => 'test@example.com',
            'PK' => 'org_foo_pk',
            'members' => ['count' => 2],
            'profiles' => [
                'count' => 3,
                'max' => 100,
            ],
            'users' => [
                'count' => 4,
                'max' => 400,
                'price' => 2,
            ],
            'routers' => [
                'count' => 4,
                'max' => 400,
                'price' => 2,
            ],
            'sub_organizations' => [
                'count' => 3,
                'max' => 5,
            ],
        ],
        new Organization(
            pk: 'org_foo_pk',
            parentOrganizationPk: null,
            parentOrganizationName: null,
            parentProfile: null,
            status: true,
            name: 'Main Inc',
            contactEmail: 'test@example.com',
            contactName: '',
            contactPhone: '',
            website: 'example.com',
            address: '123 Totally Real St, Toronto',
            statsEndpoint: '',
            twoFactorAuthenticationRequired: false,
            date: CarbonImmutable::make('2000-01-01'),
            priceUsers: 2.00,
            maxLegacyResolvers: 10,
            maxProfiles: 100,
            maxUsers: 400,
            maxRouters: 10,
            maxSubOrganizations: 5,
            members: new OrganizationLimit(
                count: 2,
                max: null,
                price: null,
            ),
            profiles: new OrganizationLimit(
                count: 3,
                max: 100,
                price: null,
            ),
            users: new OrganizationLimit(
                count: 4,
                max: 400,
                price: 2,
            ),
            routers: new OrganizationLimit(
                count: 4,
                max: 400,
                price: 2,
            ),
            subOrganizations: new OrganizationLimit(
                count: 3,
                max: 5,
                price: null,
            ),
        ),
    ],
    [
        [
            'max_profiles' => 100,
            'status' => 1,
            'max_users' => 400,
            'max_legacy_resolvers' => 10,
            'name' => 'Main Inc',
            'date' => '2000-01-01',
            'max_routers' => 10,
            'price_routers' => 10,
            'contact_email' => 'test@example.com',
            'PK' => 'org_foo_pk',
            'members' => ['count' => 2],
            'profiles' => [
                'count' => 3,
                'max' => 100,
            ],
            'users' => [
                'count' => 4,
                'max' => 400,
                'price' => 2,
            ],
            'routers' => [
                'count' => 4,
                'max' => 400,
                'price' => 2,
            ],
            'sub_organizations' => [
                'count' => 0,
                'max' => 0,
            ],
            // new
            'stats_endpoint' => 'jfk-org01',
            'parent_profile' => [
                'PK' => 'profile_pk',
                'updated' => 111111111,
                'name' => 'Main Profile',
            ],
            'contact_name' => 'name',
            'contact_phone' => '+111111111',
            'twofa_req' => 1,
            'parent_org' => [
                'name' => 'Main Inc',
                'PK' => 'parent_org_pk',
            ],
        ],
        new Organization(
            pk: 'org_foo_pk',
            parentOrganizationPk: 'parent_org_pk',
            parentOrganizationName: 'Main Inc',
            parentProfile: new Profile(
                pk: 'profile_pk',
                updated: 111111111,
                name: 'Main Profile',
                disableTtl: null,
                stats: null,
                filters: null,
            ),
            status: true,
            name: 'Main Inc',
            contactEmail: 'test@example.com',
            contactName: 'name',
            contactPhone: '+111111111',
            website: '',
            address: '',
            statsEndpoint: 'jfk-org01',
            twoFactorAuthenticationRequired: true,
            date: CarbonImmutable::make('2000-01-01'),
            priceUsers: 0.0,
            maxLegacyResolvers: 10,
            maxProfiles: 100,
            maxUsers: 400,
            maxRouters: 10,
            maxSubOrganizations: 0,
            members: new OrganizationLimit(
                count: 2,
                max: null,
                price: null,
            ),
            profiles: new OrganizationLimit(
                count: 3,
                max: 100,
                price: null,
            ),
            users: new OrganizationLimit(
                count: 4,
                max: 400,
                price: 2,
            ),
            routers: new OrganizationLimit(
                count: 4,
                max: 400,
                price: 2,
            ),
            subOrganizations: new OrganizationLimit(
                count: 0,
                max: 0,
                price: null,
            ),
        ),
    ],
]);
