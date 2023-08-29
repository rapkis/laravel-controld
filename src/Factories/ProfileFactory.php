<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Responses\Profile;
use Rapkis\Controld\Entities\ProfileFilters;

class ProfileFactory
{
    public function make(array $profile): Profile
    {
        return new Profile(
            pk: $profile['PK'],
            updated: $profile['updated'],
            name: $profile['name'],
            disableTtl: $profile['disable_ttl'] ?? null,
            stats: $profile['stats'] ?? null,
            filters: new ProfileFilters(
                flt: $profile['profile']['flt'],
                cflt: $profile['profile']['cflt'],
                ipflt: $profile['profile']['ipflt'],
                rule: $profile['profile']['rule'],
                svc: $profile['profile']['svc'],
                grp: $profile['profile']['grp'],
                opt: $profile['profile']['opt'],
                da: $profile['profile']['da'],
            )
        );
    }
}
