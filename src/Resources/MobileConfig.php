<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;

class MobileConfig
{
    public function __construct(private readonly PendingRequest $client)
    {
    }

    public function generateProfile(
        string $devicePk,
        array $excludeWifi = [],
        array $excludeDomain = [],
        bool $dontSign = false,
        bool $excludeCommon = false,
        ?string $clientId = null,
    ): string {
        return $this->client->get("mobileconfig/{$devicePk}", [
            'exclude_wifi' => $excludeWifi,
            'exclude_domain' => $excludeDomain,
            'dont_sign' => (int) $dontSign,
            'exclude_common' => (int) $excludeCommon,
            'client_id' => $clientId,
        ])->body();
    }
}
