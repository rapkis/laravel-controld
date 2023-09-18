<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Rapkis\Controld\Factories\ServiceCategoryFactory;
use Rapkis\Controld\Factories\ServiceFactory;
use Rapkis\Controld\Resources\Services;
use Rapkis\Controld\Responses\ServiceCategories;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('lists service categories', function () {
    $request = Http::fake([
        'services/categories' => Http::response(mockJsonEndpoint('services-categories')),
    ])->asJson();

    $resource = new Services(
        $request,
        app(ServiceCategoryFactory::class),
        $this->createStub(ServiceFactory::class),
    );

    $result = $resource->categories();

    expect($result)->toBeInstanceOf(ServiceCategories::class)
        ->and($result)->toHaveCount(6);
});

it('lists services for category', function () {
    $request = Http::fake([
        'services/categories/category_pk' => Http::response(mockJsonEndpoint('services-services')),
    ])->asJson();

    $resource = new Services(
        $request,
        $this->createStub(ServiceCategoryFactory::class),
        app(ServiceFactory::class),
    );

    $result = $resource->services('category_pk');

    expect($result)->toBeInstanceOf(\Rapkis\Controld\Responses\Services::class)
        ->and($result)->toHaveCount(15);
});
