<?php

declare(strict_types=1);

namespace Rapkis\Controld\Enums;

enum DeviceStatus: int
{
    case PENDING = 0;
    case ENABLED = 1;
    case SOFT_DISABLED = 2;
    case HARD_DISABLED = 3;
}
