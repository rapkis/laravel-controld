<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\Member;
use Rapkis\Controld\Entities\Permission;
use Rapkis\Controld\Factories\MemberFactory;

it('builds a organization', function (array $data, Member $expected) {
    expect((new MemberFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'member_pk',
            'email' => 'test@example.com',
            'last_active' => 111111111,
            'twofa' => 0,
            'status' => 1,
            'permission' => [
                'level' => 100,
                'printable' => 'Owner',
            ],
        ],
        new Member(
            pk: 'member_pk',
            email: 'test@example.com',
            last_active: 111111111,
            twoFactorAuthentication: false,
            status: true,
            permission: new Permission(
                level: 100,
                printable: 'Owner',
            )
        ),
    ],
]);
