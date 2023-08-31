<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Responses\RuleFolder;

class RuleFolderFactory implements Factory
{
    public function make(array $data): RuleFolder
    {
        return new RuleFolder(
            pk: $data['PK'],
            group: $data['group'],
            action: new Action(
                status: (bool) $data['action']['status'],
                do: $data['action']['do'] ?? null,
                via: $data['action']['via'] ?? null,
            ),
            count: $data['count'],
        );
    }
}
