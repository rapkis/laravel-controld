<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\LearnedIpFactory;
use Rapkis\Controld\Responses\LearnedIps;

class Access
{
    public function __construct(private readonly PendingRequest $client, private readonly LearnedIpFactory $learnedIp)
    {
    }

    public function list(string $devicePk): LearnedIps
    {
        $response = $this->client->get('access', ['device_id' => $devicePk])->json('body.ips');

        $result = new LearnedIps();

        foreach ($response as $learnedIp) {
            $learnedIp = $this->learnedIp->make($learnedIp);
            $result->put($learnedIp->ip, $learnedIp);
        }

        return $result;
    }

    public function learn(string $devicePk, array $ips): bool
    {
        $this->client->post('access', [
            'device_id' => $devicePk,
            'ips' => $ips,
        ]);

        return true;
    }

    public function delete(string $devicePk, array $ips): bool
    {
        $this->client->delete('access', [
            'device_id' => $devicePk,
            'ips' => $ips,
        ]);

        return true;
    }
}
