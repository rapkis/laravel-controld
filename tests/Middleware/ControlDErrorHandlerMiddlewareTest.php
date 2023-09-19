<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Rapkis\Controld\Exceptions\ControlDErrorException;
use Rapkis\Controld\Middleware\ControlDErrorHandlerMiddleware;

it('handles error', function () {
    $response = new Response(404, [], mockJsonEndpoint('profiles-delete-error'));
    (new ControlDErrorHandlerMiddleware())($response);
})->throws(ControlDErrorException::class, 'This profile does not exist', 40401);

it('handles success', function (array $headers) {
    $response = new Response(404, $headers, mockJsonEndpoint('profiles-delete'));
    expect((new ControlDErrorHandlerMiddleware())($response))->toBeInstanceOf(ResponseInterface::class);
})->with([
    [['Content-Type' => 'application/json']],
    [[]],
]);

it('skips non-json', function () {
    $response = new Response(404, [], null);
    expect((new ControlDErrorHandlerMiddleware())($response))->toBeInstanceOf(ResponseInterface::class);
});

it('handles missing json response data', function () {
    $response = new Response(404, ['Content-Type' => 'application/json'], 'malformed json');
    (new ControlDErrorHandlerMiddleware())($response);
})->throws(ControlDErrorException::class, 'An unknown ControlD error has occurred', 500);
