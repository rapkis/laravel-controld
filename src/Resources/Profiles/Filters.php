<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\FilterFactory;

class Filters
{
    public function __construct(private readonly PendingRequest $client, private readonly FilterFactory $filter)
    {
    }

    public function native(string $profilePk): \Rapkis\Controld\Responses\Filters
    {
        $response = $this->client->get("profiles/{$profilePk}/filters")->json('body.filters');

        $result = new \Rapkis\Controld\Responses\Filters();

        foreach ($response as $filter) {
            $filter = $this->filter->make($filter);
            $result[$filter->pk] = $filter;
        }

        return $result;
    }

    public function thirdParty(string $profilePk): \Rapkis\Controld\Responses\Filters
    {
        $response = $this->client->get("profiles/{$profilePk}/filters/external")->json('body.filters');

        $result = new \Rapkis\Controld\Responses\Filters();

        foreach ($response as $filter) {
            $filter = $this->filter->make($filter);
            $result[$filter->pk] = $filter;
        }

        return $result;
    }

    /**
     * Enable or disable a filter for a profile.
     * Returns a list of filter PKs
     *
     * @return array<string>
     */
    public function modify(string $profilePk, string $filterPk, bool $enable): array
    {
        return $this->client->put("profiles/{$profilePk}/filters/filter/{$filterPk}", ['status' => (int) $enable])
            ->json('body.filters');
    }
}
