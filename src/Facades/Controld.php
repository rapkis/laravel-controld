<?php

namespace Rapkis\Controld\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rapkis\Controld\Controld
 */
class Controld extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rapkis\Controld\Controld::class;
    }
}
