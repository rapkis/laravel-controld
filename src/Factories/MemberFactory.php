<?php

declare(strict_types=1);

namespace Rapkis\Controld\Factories;

use Rapkis\Controld\Contracts\Factories\Factory;
use Rapkis\Controld\Entities\Member;
use Rapkis\Controld\Entities\Permission;

class MemberFactory implements Factory
{
    public function make(array $data): Member
    {
        return new Member(
            pk: $data['PK'],
            email: $data['email'],
            last_active: (int) $data['last_active'],
            twoFactorAuthentication: (bool) $data['twofa'],
            status: (bool) $data['status'],
            permission: new Permission(
                level: (int) $data['permission']['level'],
                printable: $data['permission']['printable'],
            )
        );
    }
}
