<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Carbon\CarbonImmutable;
use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Responses\UserData;

class UserDataFactory implements Factory
{
    public function make(array $data): UserData
    {
        return new UserData(
            pk: $data['PK'],
            date: CarbonImmutable::make($data['date']),
            status: (bool) $data['status'],
            email: $data['email'],
            emailStatus: (bool) $data['email_status'],
            tutorials: ! (($data['tutorials'] ?? 0)), // tutorial is inverted for some reason, so we fix it here
            v: $data['v'] ?? 2,
            proxyAccess: (bool) $data['proxy_access'],
            lastActive: (int) $data['last_active'],
            twoFactorAuthentication: (bool) $data['twofa'],
            analyticsRegion: $data['stats_endpoint'],
            debug: $data['debug'] ?? [],
        );
    }
}
