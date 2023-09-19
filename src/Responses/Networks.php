<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use Illuminate\Support\Collection;

class Networks extends Collection
{
    public function __construct(public readonly int $time, public readonly string $currentPop, $items = [])
    {
        parent::__construct($items);
    }
}
