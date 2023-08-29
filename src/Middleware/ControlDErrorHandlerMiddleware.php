<?php

declare(strict_types=1);

namespace Rapkis\Controld\Middleware;

use Psr\Http\Message\ResponseInterface;
use Rapkis\Controld\Contracts\Middleware\ResponseMiddleware;
use Rapkis\Controld\Exceptions\ControlDErrorException;

class ControlDErrorHandlerMiddleware implements ResponseMiddleware
{
    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        $this->handleResponse($response);

        return $response;
    }

    protected function handleResponse(ResponseInterface $response): void
    {
        $data = json_decode($response->getBody()->getContents(), true);

        if (($data['success'] ?? false)) {
            return;
        }

        throw new ControlDErrorException(
            $data['error']['message'] ?? 'An ControlD unknown error has occurred',
            $data['error']['code'] ?? 500,
        );
    }
}
