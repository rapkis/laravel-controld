<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\ProxyFactory;

class Proxies
{
    public function __construct(private readonly PendingRequest $client, private readonly ProxyFactory $proxy)
    {
    }

    public function list(): \Rapkis\Controld\Responses\Proxies
    {
        $response = $this->client->get('proxies')->json('body.proxies');

        $result = new \Rapkis\Controld\Responses\Proxies();

        foreach ($response as $proxy) {
            $proxy = $this->proxy->make($proxy);
            $result->put($proxy->pk, $proxy);
        }

        return $result;
    }
}
