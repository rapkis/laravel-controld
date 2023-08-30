<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\ProfileOptionFactory;
use Rapkis\Controld\Responses\ProfileOptions;

class Options
{
    public function __construct(private readonly PendingRequest $client, private readonly ProfileOptionFactory $option)
    {
    }

    public function list(): ProfileOptions
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
    public function modify(string $profilePk, string $optionPk, bool $enable): bool
    {
        $this->client->put("profiles/{$profilePk}/options/{$optionPk}", [
            'status' => (int) $enable,
        ]);

        return true;
    }
}
