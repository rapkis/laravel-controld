<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Entities\ServiceAction;
use Rapkis\Controld\Factories\ServiceFactory;

class Services
{
    public function __construct(private readonly PendingRequest $client, private readonly ServiceFactory $service)
    {
    }

    public function list(string $profilePk): \Rapkis\Controld\Responses\Services
    {
        $response = $this->client->get("profiles/{$profilePk}/services")->json('body.services');

        $result = new \Rapkis\Controld\Responses\Services();

        foreach ($response as $service) {
            $service = $this->service->make($service);
            $result[$service->pk] = $service;
        }

        return $result;
    }

    public function modify(string $profilePk, string $servicePk, ServiceAction $action): bool
    {
        $this->client->put("profiles/{$profilePk}/services/{$servicePk}", [
            'do' => $action->do,
            'status' => (int) $action->status,
            'via' => $action->via,
        ]);

        return true;
    }
}
