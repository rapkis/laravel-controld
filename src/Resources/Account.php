<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\UserDataFactory;
use Rapkis\Controld\Responses\UserData;

class Account
{
    public function __construct(private readonly PendingRequest $client, private readonly UserDataFactory $user)
    {
    }

    public function users(): UserData
    {
        return $this->user->make($this->client->get('users')->json('body'));
    }
}
