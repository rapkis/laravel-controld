<?php

declare(strict_types=1);

namespace Rapkis\Controld\Tests\Middleware;

use Psr\Http\Message\RequestInterface;
use Rapkis\Controld\Contracts\Middleware\RequestMiddleware;

class TestRequestMiddleware implements RequestMiddleware
{
    public function __invoke(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('test', 'test');
    }
}
