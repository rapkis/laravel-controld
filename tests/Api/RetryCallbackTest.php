<?php

declare(strict_types=1);

use Illuminate\Http\Client\ConnectionException;
use Rapkis\Controld\Api\RetryCallback;

it('will retry for exception', function (Throwable $exception, bool $willRetry) {
    $retry = new RetryCallback();

    expect($retry($exception))->toBe($willRetry);
})->with([
    [new Exception(), false],
    [new Exception('', 500), true],
    [new Exception('', 422), false],
    [new ConnectionException(), true],
]);
