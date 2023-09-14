<?php

declare(strict_types=1);

namespace Rapkis\Controld;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Resources\Access;
use Rapkis\Controld\Resources\Devices;
use Rapkis\Controld\Resources\Profiles;

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
}
