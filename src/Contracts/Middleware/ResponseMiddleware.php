<?php

declare(strict_types=1);

namespace Rapkis\Controld\Contracts\Middleware;

use Psr\Http\Message\ResponseInterface;

interface ResponseMiddleware
{
    public function __invoke(ResponseInterface $response): ResponseInterface;
}
