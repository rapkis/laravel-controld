<?php

declare(strict_types=1);

namespace Rapkis\Controld\Api;

use Illuminate\Config\Repository;
use Illuminate\Http\Client\ConnectionException;
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

        foreach ($this->config->get('controld.middleware') ?? [] as $middleware) {
            $this->request->withMiddleware(app($middleware));
        }

        return new ControlD($this->request);
    }
}
