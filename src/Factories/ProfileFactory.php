<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\ProfileFilters;
use Rapkis\Controld\Responses\Profile;

class ProfileFactory implements Factory
{
    public function make(array $data): Profile
    {
        return new Profile(
            pk: $data['PK'],
            updated: $data['updated'],
            name: $data['name'],
            disableTtl: $data['disable_ttl'] ?? null,
            stats: $data['stats'] ?? null,
            filters: new ProfileFilters(
                flt: $data['profile']['flt'],
                cflt: $data['profile']['cflt'],
                ipflt: $data['profile']['ipflt'],
                rule: $data['profile']['rule'],
                svc: $data['profile']['svc'],
                grp: $data['profile']['grp'],
                opt: $data['profile']['opt'],
                da: $data['profile']['da'],
            )
        );
    }
}
