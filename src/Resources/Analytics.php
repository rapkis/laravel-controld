<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;

class Analytics
{
    public function __construct(private readonly PendingRequest $client)
    {
    }

    public function levels(): array
    {
        return $this->client->get('analytics/levels')->json('body.levels');
    }

    public function regions(): array
    {
        return $this->client->get('analytics/endpoints')->json('body.endpoints');
    }
}
