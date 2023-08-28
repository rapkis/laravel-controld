<?php

use Illuminate\Config\Repository;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Api\ControlDFactory;
use Rapkis\Controld\Tests\Api\TestMiddleware;

it('creates an api client', function () {
    $config = app(Repository::class);
    $request = $this->createMock(PendingRequest::class);
    $factory = new ControlDFactory($request, $config);
    app()->bind(TestMiddleware::class, fn () => $this->createStub(TestMiddleware::class));

    $config->set([
        'controld' => [
            'url' => 'example.com',
            'secret' => 'bearer_token',
            'middleware' => [TestMiddleware::class],
        ],
    ]);

    $request->expects($this->once())->method('asJson')->willReturnSelf();
    $request->expects($this->once())->method('acceptJson')->willReturnSelf();
    $request->expects($this->once())->method('baseUrl')->with('example.com')->willReturnSelf();
    $request->expects($this->once())->method('withToken')->with('bearer_token')->willReturnSelf();

    $request->expects($this->once())->method('withMiddleware')
        ->with($this->createStub(TestMiddleware::class))
        ->willReturnSelf();

    $request->expects($this->once())->method('retry')->with(3, 250, function ($e) {
        return $e instanceof ConnectionException || $e->getCode() >= 500;
    })->willReturnSelf();

    $factory->make();
});
