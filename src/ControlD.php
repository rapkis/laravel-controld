<?php

declare(strict_types=1);

namespace Rapkis\Controld;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Resources\Access;
use Rapkis\Controld\Resources\Account;
use Rapkis\Controld\Resources\Analytics;
use Rapkis\Controld\Resources\Devices;
use Rapkis\Controld\Resources\Organizations;
use Rapkis\Controld\Resources\Profiles;
use Rapkis\Controld\Resources\Services;

class ControlD
{
    public function __construct(private PendingRequest $request)
    {
    }

    public function profiles(): Profiles
    {
        return app(Profiles::class, ['client' => $this->request]);
    }

    public function devices(): Devices
    {
        return app(Devices::class, ['client' => $this->request]);
    }

    public function access(): Access
    {
        return app(Access::class, ['client' => $this->request]);
    }

    public function services(): Services
    {
        return app(Services::class, ['client' => $this->request]);
    }

    public function analytics(): Analytics
    {
        return app(Analytics::class, ['client' => $this->request]);
    }

    public function account(): Account
    {
        return app(Account::class, ['client' => $this->request]);
    }

    public function organizations(): Organizations
    {
        return app(Organizations::class, ['client' => $this->request]);
    }
}
