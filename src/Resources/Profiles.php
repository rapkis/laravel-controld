<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\ProfileFactory;
use Rapkis\Controld\Resources\Profiles\CustomRules;
use Rapkis\Controld\Resources\Profiles\Filters;
use Rapkis\Controld\Resources\Profiles\Options;
use Rapkis\Controld\Resources\Profiles\RuleFolders;
use Rapkis\Controld\Resources\Profiles\Services;
use Rapkis\Controld\Responses\Profile;
use Rapkis\Controld\Responses\ProfileList;

class Profiles
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly ProfileFactory $profile,
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

    public function options(): Options
    {
        return app(Options::class, ['client' => $this->client]);
    }

    public function filters(): Filters
    {
        return app(Filters::class, ['client' => $this->client]);
    }

    public function services(): Services
    {
        return app(Services::class, ['client' => $this->client]);
    }

    public function ruleFolders(): RuleFolders
    {
        return app(RuleFolders::class, ['client' => $this->client]);
    }

    public function customRules(): CustomRules
    {
        return app(CustomRules::class, ['client' => $this->client]);
    }
}
