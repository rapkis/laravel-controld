<?php

declare(strict_types=1);

namespace Rapkis\Controld\Enums;

enum DeviceAnalytics: int
{
    case OFF = 0;
    case SOME = 1;
    case FULL = 2;
}
