<?php

declare(strict_types=1);

namespace Rapkis\Controld\Entities;

class Member
{
    public function __construct(
        public readonly string $pk,
        public readonly string $email,
        public readonly int $last_active,
        public readonly bool $twoFactorAuthentication,
        public readonly bool $status,
        public readonly Permission $permission,
    ) {
    }
}
