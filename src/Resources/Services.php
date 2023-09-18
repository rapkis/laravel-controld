<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\ServiceCategoryFactory;
use Rapkis\Controld\Factories\ServiceFactory;
use Rapkis\Controld\Responses\ServiceCategories;

class Services
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly ServiceCategoryFactory $category,
        private readonly ServiceFactory $service,
    ) {
    }

    public function categories(): ServiceCategories
    {
        $response = $this->client->get('services/categories')->json('body.categories');

        $result = new ServiceCategories();

        foreach ($response as $category) {
            $category = $this->category->make($category);
            $result->put($category->pk, $category);
        }

        return $result;
    }

    public function services(string $categoryPk): \Rapkis\Controld\Responses\Services
    {
        $response = $this->client->get("services/categories/{$categoryPk}")->json('body.services');

        $result = new \Rapkis\Controld\Responses\Services();

        foreach ($response as $service) {
            $service = $this->service->make($service);
            $result[$service->pk] = $service;
        }

        return $result;
    }
}
