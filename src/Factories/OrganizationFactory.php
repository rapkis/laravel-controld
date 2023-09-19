<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Carbon\CarbonImmutable;
use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\OrganizationLimit;
use Rapkis\Controld\Responses\Organization;

class OrganizationFactory implements Factory
{
    public function make(array $data): Organization
    {
        if (! empty($data['parent_profile'])) {
            $parentProfile = (new ProfileFactory())->make($data['parent_profile']);
        }

        return new Organization(
            pk: $data['PK'],
            parentOrganizationPk: $data['parent_org']['PK'] ?? null,
            parentOrganizationName: $data['parent_org']['name'] ?? null,
            parentProfile: $parentProfile ?? null,
            status: (bool) $data['status'],
            name: $data['name'],
            contactEmail: $data['contact_email'],
            contactName: $data['contact_name'] ?? '',
            contactPhone: $data['contact_phone'] ?? '',
            website: $data['website'] ?? '',
            address: $data['address'] ?? '',
            statsEndpoint: $data['stats_endpoint'],
            twoFactorAuthenticationRequired: (bool) ($data['twofa_req'] ?? null),
            date: CarbonImmutable::make($data['date']),
            priceUsers: (float) ($data['price_users'] ?? null),
            maxLegacyResolvers: (int) $data['max_legacy_resolvers'],
            maxProfiles: (int) $data['max_profiles'],
            maxUsers: (int) $data['max_users'],
            maxRouters: (int) $data['max_routers'],
            maxSubOrganizations: (int) ($data['max_sub_orgs'] ?? null),
            members: $this->makeOrganizationLimit($data, 'members'),
            profiles: $this->makeOrganizationLimit($data, 'profiles'),
            users: $this->makeOrganizationLimit($data, 'users'),
            routers: $this->makeOrganizationLimit($data, 'routers'),
            subOrganizations: $this->makeOrganizationLimit($data, 'sub_organizations'),
        );
    }

    private function makeOrganizationLimit(array $data, string $type): OrganizationLimit
    {
        return new OrganizationLimit(
            count: (int) ($data[$type]['count'] ?? null),
            max: ! empty($data[$type]['max']) ? (int) $data[$type]['max'] : null,
            price: ! empty($data[$type]['price']) ? (float) $data[$type]['price'] : null,
        );
    }
}
