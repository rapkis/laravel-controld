<?php

use Illuminate\Config\Repository;
use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\ControlDFactory;
use Rapkis\Controld\RetryCallback;
use Rapkis\Controld\Tests\Middleware\TestMiddleware;

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

    $request->expects($this->once())->method('retry')
        ->with(3, 250, new RetryCallback())
        ->willReturnSelf();

    $factory->make();
});
