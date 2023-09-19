<?php

declare(strict_types=1);

namespace Rapkis\Controld\Responses;

use DateTimeInterface;

class UserData
{
    public function __construct(
        public readonly string $pk,
        public readonly DateTimeInterface $date,
        public readonly bool $status,
        public readonly string $email,
        public readonly bool $emailStatus,
        public readonly bool $tutorials,
        public readonly int $v,
        public readonly bool $proxyAccess,
        public readonly int $lastActive,
        public readonly bool $twoFactorAuthentication,
        public readonly string $statsEndpoint,
        public readonly array $debug,
    ) {
    }
}
