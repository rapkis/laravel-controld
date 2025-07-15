<?php

declare(strict_types=1);

namespace Rapkis\Controld;

use Illuminate\Config\Repository;
use Illuminate\Http\Client\PendingRequest;

class ControlDFactory
{
    public function __construct(private PendingRequest $request, private Repository $config)
    {
    }

    public function make(): ControlD
    {
        $this->request
            ->asJson()
            ->acceptJson()
            ->baseUrl($this->config->get('controld.url'))
            ->withToken($this->config->get('controld.secret'))
            ->retry(3, 250, new RetryCallback());

        foreach ($this->config->get('controld.middleware.request', []) as $middleware) {
            $this->validateAndApplyMiddleware($middleware, 'request');
        }

        foreach ($this->config->get('controld.middleware.response', []) as $middleware) {
            $this->validateAndApplyMiddleware($middleware, 'response');
        }

        return new ControlD($this->request);
    }

    /**
     * Validate and apply middleware to the request client.
     */
    private function validateAndApplyMiddleware(string $middleware, string $type): void
    {
        if (! class_exists($middleware)) {
            throw new \InvalidArgumentException("Middleware class {$middleware} does not exist");
        }

        $instance = new $middleware();
        
        if ($type === 'request') {
            $this->request->withRequestMiddleware($instance);
        } else {
            $this->request->withResponseMiddleware($instance);
        }
    }
}
