<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Factories\RuleFolderFactory;
use Rapkis\Controld\Responses\RuleFolder;

it('builds a rule folder', function (array $data, RuleFolder $expected) {
    expect((new RuleFolderFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 1,
            'group' => 'Folder Name',
            'action' => ['status' => 1],
            'count' => 0,
        ],
        new RuleFolder(
            pk: 1,
            group: 'Folder Name',
            action: new Action(true, null, null, null),
            count: 0,
        ),
    ],
    [
        [
            'PK' => 1,
            'group' => 'Redirect everything',
            'action' => [
                'do' => 3,
                'via' => 'LOCAL',
                'status' => 1,
            ],
            'count' => 1,
        ],
        new RuleFolder(
            pk: 1,
            group: 'Redirect everything',
            action: new Action(true, 3, 'LOCAL', null),
            count: 1,
        ),
    ],
    [
        [
            'PK' => 1,
            'group' => 'Block everything',
            'action' => [
                'do' => 0,
                'status' => 1,
            ],
            'count' => 2,
        ],
        new RuleFolder(
            pk: 1,
            group: 'Block everything',
            action: new Action(true, 0, null, null),
            count: 2,
        ),
    ],
]);
