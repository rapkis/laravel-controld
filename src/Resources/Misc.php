<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\DatacenterIpFactory;
use Rapkis\Controld\Factories\NetworkFactory;
use Rapkis\Controld\Responses\DatacenterIp;
use Rapkis\Controld\Responses\Networks;

class Misc
{
    public function __construct(
        private readonly PendingRequest $client,
        private readonly DatacenterIpFactory $ip,
        private readonly NetworkFactory $network,
    ) {
    }

    public function ip(): DatacenterIp
    {
        return $this->ip->make($this->client->get('ip')->json('body'));
    }

    public function networkStats(): Networks
    {
        $response = $this->client->get('network')->json('body');

        $result = new Networks(time: $response['time'], currentPop: $response['current_pop']);

        foreach ($response['network'] as $network) {
            $network = $this->network->make($network);
            $result->put($network->iataCode, $network);
        }

        return $result;
    }
}
