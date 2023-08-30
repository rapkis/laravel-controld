<?php

declare(strict_types=1);

namespace Rapkis\Controld\Contracts\Factories;

interface Factory
{
    public function make(array $data);
}
