<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Responses\CustomRule;

class CustomRuleFactory implements Factory
{
    public function make(array $data): CustomRule
    {
        return new CustomRule(
            pk: $data['PK'],
            order: $data['order'],
            group: $data['group'],
            action: (new ActionFactory())->make($data['action']),
        );
    }
}
