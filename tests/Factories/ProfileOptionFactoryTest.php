<?php

declare(strict_types=1);

use Rapkis\Controld\Entities\ProfileOption;
use Rapkis\Controld\Factories\ProfileOptionFactory;

it('builds a profile option', function (array $data, ProfileOption $expected) {
    expect((new ProfileOptionFactory())->make($data))->toEqual($expected);
})->with([
    [
        [
            'PK' => 'block_foo_false',
            'title' => 'This is a toggle option',
            'description' => 'This set represents an option that can be toggled',
            'type' => 'toggle',
            'default_value' => 0,
            'info_url' => 'https://example.com',
        ],
        new ProfileOption(
            pk: 'block_foo_false',
            title: 'This is a toggle option',
            description: 'This set represents an option that can be toggled',
            type: 'toggle',
            default: false,
            infoUrl: 'https://example.com',
        ),
    ],
    [
        [
            'PK' => 'block_bar_true',
            'title' => 'This is a toggle option',
            'description' => 'This set represents an option that can be toggled. It is on by default',
            'type' => 'toggle',
            'default_value' => 1,
            'info_url' => 'https://example.com',
        ],
        new ProfileOption(
            pk: 'block_bar_true',
            title: 'This is a toggle option',
            description: 'This set represents an option that can be toggled. It is on by default',
            type: 'toggle',
            default: true,
            infoUrl: 'https://example.com',
        ),
    ],
    [
        [
            'PK' => 'dropdown_multiple',
            'title' => 'This is a dropdown option',
            'description' => 'This set represents an option can have multiple values',
            'type' => 'dropdown',
            'default_value' => [],
            'info_url' => 'https://example.com',
        ],
        new ProfileOption(
            pk: 'dropdown_multiple',
            title: 'This is a dropdown option',
            description: 'This set represents an option can have multiple values',
            type: 'dropdown',
            default: [],
            infoUrl: 'https://example.com',
        ),
    ],
    [
        [
            'PK' => 'dropdown_multiple_with_options',
            'title' => 'This is a dropdown option',
            'description' => 'This set represents an option can have multiple values. It has default values',
            'type' => 'dropdown',
            'default_value' => [
                '0.9' => 'Zero point nine',
                1 => 'Number one',
            ],
            'info_url' => 'https://example.com',
        ],
        new ProfileOption(
            pk: 'dropdown_multiple_with_options',
            title: 'This is a dropdown option',
            description: 'This set represents an option can have multiple values. It has default values',
            type: 'dropdown',
            default: [
                '0.9' => 'Zero point nine',
                1 => 'Number one',
            ],
            infoUrl: 'https://example.com',
        ),
    ],
    [
        [
            'PK' => 'input_field_option',
            'title' => 'This is an option with user input',
            'description' => 'This set represents an option that can modified by the user',
            'type' => 'field',
            'default_value' => 1,
            'info_url' => 'https://example.com',
        ],
        new ProfileOption(
            pk: 'input_field_option',
            title: 'This is an option with user input',
            description: 'This set represents an option that can modified by the user',
            type: 'field',
            default: 1,
            infoUrl: 'https://example.com',
        ),
    ],
]);

it('casts boolean values', function () {
    $option = (new ProfileOptionFactory())->make([
        'PK' => 'block_foo_false',
        'title' => 'This is a toggle option',
        'description' => 'This set represents an option that can be toggled',
        'type' => 'toggle',
        'default_value' => 0,
        'info_url' => 'https://example.com',
    ]);

    expect($option->default)->toBeFalse();

    $option = (new ProfileOptionFactory())->make([
        'PK' => 'block_bar_true',
        'title' => 'This is a toggle option',
        'description' => 'This set represents an option that can be toggled. It is on by default',
        'type' => 'toggle',
        'default_value' => 1,
        'info_url' => 'https://example.com',
    ]);

    expect($option->default)->toBeTrue();
});
