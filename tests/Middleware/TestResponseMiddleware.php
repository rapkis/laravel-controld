<?php

declare(strict_types=1);

namespace Rapkis\Controld\Tests\Middleware;

use Psr\Http\Message\ResponseInterface;
use Rapkis\Controld\Contracts\Middleware\ResponseMiddleware;

class TestResponseMiddleware implements ResponseMiddleware
{
    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}
