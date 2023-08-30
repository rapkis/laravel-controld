<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Entities\ServiceAction;
use Rapkis\Controld\Factories\FilterFactory;
use Rapkis\Controld\Factories\ProfileFactory;
use Rapkis\Controld\Factories\ProfileOptionFactory;
use Rapkis\Controld\Factories\ServiceFactory;
use Rapkis\Controld\Responses\Filters;
use Rapkis\Controld\Responses\Profile;
use Rapkis\Controld\Responses\ProfileList;
use Rapkis\Controld\Responses\ProfileOptions;
use Rapkis\Controld\Responses\Services;

class Profiles
{
    public function __construct(
        private PendingRequest $client,
        private ProfileFactory $profile,
        private ProfileOptionFactory $option,
        private FilterFactory $filter,
        private ServiceFactory $service,
    ) {
    }

    public function list(): ProfileList
    {
        $response = $this->client->get('profiles')->json('body.profiles');

        $result = new ProfileList();

        foreach ($response as $profile) {
            $profile = $this->profile->make($profile);
            $result->put($profile->pk, $profile);
        }

        return $result;
    }

    public function create(string $name, string $cloneProfileId = null): Profile
    {
        $profile = $this->client->post('profiles', [
            'name' => $name,
            'clone_profile_id' => $cloneProfileId,
        ])->json('body.profiles.0');

        return $this->profile->make($profile);
    }

    public function modify(string $profilePk, string $name = null, int $disableTtl = null): Profile
    {
        $profile = $this->client->post("profiles/{$profilePk}", [
            'name' => $name,
            'disable_tll' => $disableTtl,
        ])->json('body.profiles.0');

        return $this->profile->make($profile);
    }

    public function delete(string $profilePk): bool
    {
        $this->client->delete("profiles/{$profilePk}");

        return true;
    }

    public function options(): ProfileOptions
    {
        $response = $this->client->get('profiles/options')->json('body.options');

        $result = new ProfileOptions();

        foreach ($response as $option) {
            $option = $this->option->make($option);
            $result->put($option->pk, $option);
        }

        return $result;
    }

    /**
     * At the time of writing, ControlD only supports on/of values,
     * even though ai_malware option does not accept those.
     * This may change, after this experimental option is finalised.
     */
    public function modifyOption(string $profilePk, string $optionPk, bool $enable): bool
    {
        $this->client->put("profiles/{$profilePk}/options/{$optionPk}", [
            'status' => (int) $enable,
        ]);

        return true;
    }

    public function listNativeFilters(string $profilePk): Filters
    {
        $response = $this->client->get("profiles/{$profilePk}/filters")->json('body.filters');

        $result = new Filters();

        foreach ($response as $filter) {
            $filter = $this->filter->make($filter);
            $result[$filter->pk] = $filter;
        }

        return $result;
    }

    public function listThirdPartyFilters(string $profilePk): Filters
    {
        $response = $this->client->get("profiles/{$profilePk}/filters/external")->json('body.filters');

        $result = new Filters();

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
    public function modifyFilters(string $profilePk, string $filterPk, bool $enable): array
    {
        return $this->client->put("profiles/{$profilePk}/filters/filter/{$filterPk}", ['status' => (int) $enable])
            ->json('body.filters');
    }

    public function listServices(string $profilePk): Services
    {
        $response = $this->client->get("profiles/{$profilePk}/services")->json('body.services');

        $result = new Services();

        foreach ($response as $service) {
            $service = $this->service->make($service);
            $result[$service->pk] = $service;
        }

        return $result;
    }

    public function modifyService(string $profilePk, string $servicePk, ServiceAction $action): bool
    {
        $this->client->put("profiles/{$profilePk}/services/{$servicePk}", [
            'do' => $action->do,
            'status' => (int) $action->status,
            'via' => $action->via,
        ]);

        return true;
    }
}
