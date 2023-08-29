<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Entities\ProfileOption;

class ProfileOptionFactory
{
    public function make(array $data): ProfileOption
    {
        if ($data['type'] === 'toggle') {
            $data['default_value'] = (bool) $data['default_value'];
        }

        return new ProfileOption(
            pk: $data['PK'],
            title: $data['title'],
            description: $data['description'],
            type: $data['type'],
            default: $data['default_value'],
            infoUrl: $data['info_url'],
        );
    }
}
