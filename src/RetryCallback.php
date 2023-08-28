<?php

declare(strict_types=1);

namespace Rapkis\Controld;

use Illuminate\Http\Client\ConnectionException;
use Throwable;

class RetryCallback
{
    public function __invoke(Throwable $exception): bool
    {
        return $exception instanceof ConnectionException || $exception->getCode() >= 500;
    }
}
