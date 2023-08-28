<?php

declare(strict_types=1);

namespace Rapkis\Controld;

use Illuminate\Http\Client\PendingRequest;

class ControlD
{
    public function __construct(private PendingRequest $request)
    {
    }
}
