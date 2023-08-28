<?php

namespace Rapkis\Controld\Tests\Middleware;

use Closure;
use Psr\Http\Message\RequestInterface;

class TestMiddleware
{
    public function __invoke(callable $handler): Closure
    {
        return function (RequestInterface $request, array $options = []) use ($handler) {
            $request->withHeader('test', 'test');

            return $handler($request, $options);
        };
    }
}
