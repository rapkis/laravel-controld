<?php

declare(strict_types=1);

namespace Rapkis\Controld\Contracts\Middleware;

use Psr\Http\Message\RequestInterface;

interface RequestMiddleware
{
    public function __invoke(RequestInterface $request): RequestInterface;
}
