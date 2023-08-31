<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\ActionFactory;
use Rapkis\Controld\Responses\Action;

class DefaultRule
{
    public function __construct(private readonly PendingRequest $client, private readonly ActionFactory $action)
    {
    }

    public function list(string $profilePk): ?Action
    {
        $response = $this->client->get("profiles/{$profilePk}/default")->json('body.default');

        if (empty($response)) {
            return null;
        }

        return $this->action->make($response);
    }

    public function modify(string $profilePk, Action $action): Action
    {
        $response = $this->client->put("profiles/{$profilePk}/default", [
            'do' => $action->do,
            'via' => $action->via,
            'status' => (int) $action->status,
        ])->json('body.default');

        return $this->action->make($response);
    }
}
