<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use DateTimeInterface;
use Rapkis\Controld\Entities\OrganizationLimit;

class Organization
{
    public function __construct(
        public readonly string $pk,
        public readonly ?string $parentOrganizationPk,
        public readonly ?string $parentOrganizationName,
        public readonly ?Profile $parentProfile,
        public readonly bool $status,
        public readonly string $name,
        public readonly string $contactEmail,
        public readonly string $contactName,
        public readonly string $contactPhone,
        public readonly string $website,
        public readonly string $address,
        public readonly string $statsEndpoint,
        public readonly bool $twoFactorAuthenticationRequired,
        public readonly DateTimeInterface $date,
        public readonly float $priceUsers,
        public readonly int $maxLegacyResolvers,
        public readonly int $maxProfiles,
        public readonly int $maxUsers,
        public readonly int $maxRouters,
        public readonly int $maxSubOrganizations,
        public readonly OrganizationLimit $members,
        public readonly OrganizationLimit $profiles,
        public readonly OrganizationLimit $users,
        public readonly OrganizationLimit $routers,
        public readonly OrganizationLimit $subOrganizations,
    ) {
    }
}
