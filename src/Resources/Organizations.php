<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\MemberFactory;
use Rapkis\Controld\Factories\OrganizationFactory;
use Rapkis\Controld\Responses\Members;
use Rapkis\Controld\Responses\Organization;

class Organizations
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly OrganizationFactory $organization,
        private readonly MemberFactory $member,
    ) {
    }

    public function organization(): Organization
    {
        return $this->organization->make(
            $this->client->get('organizations/organization')->json('body.organization')
        );
    }

    public function members(): Members
    {
        $response = $this->client->get('organizations/members')->json('body.members');

        $result = new Members();

        foreach ($response as $member) {
            $member = $this->member->make($member);
            $result->put($member->pk, $member);
        }

        return $result;
    }

    public function subOrganizations(): \Rapkis\Controld\Responses\Organizations
    {
        $response = $this->client->get('organizations/sub_organizations')->json('body.sub_organizations');

        $result = new \Rapkis\Controld\Responses\Organizations();

        foreach ($response as $organization) {
            $organization = $this->organization->make($organization);
            $result->put($organization->pk, $organization);
        }

        return $result;
    }
}
