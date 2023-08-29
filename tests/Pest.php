<?php

use Rapkis\Controld\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function mockJsonEndpoint(string $endpoint): string
{
    return file_get_contents(__DIR__."/Mocks/Endpoints/{$endpoint}.json");
}
