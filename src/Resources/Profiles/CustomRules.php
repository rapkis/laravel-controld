<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Factories\CustomRuleFactory;
use Rapkis\Controld\Responses\Action;

class CustomRules
{
    public function __construct(private readonly PendingRequest $client, private readonly CustomRuleFactory $rule)
    {
    }

    public function list(string $profilePk, ?int $folderPk = null): \Rapkis\Controld\Responses\CustomRules
    {
        $folderPk = $folderPk ?? 'all'; // This is the default folder in ControlD that lists all rules
        $response = $this->client->get("profiles/{$profilePk}/rules/{$folderPk}")->json('body.rules');

        $result = new \Rapkis\Controld\Responses\CustomRules();

        foreach ($response as $rule) {
            $rule = $this->rule->make($rule);
            $result[$rule->pk] = $rule;
        }

        return $result;
    }

    public function create(string $profilePk, ?int $folderPk, array $hostnames, Action $action): \Rapkis\Controld\Responses\CustomRules
    {
        $response = $this->client->post("profiles/{$profilePk}/rules", [
            'group' => $folderPk,
            'do' => $action->do,
            'via' => $action->via,
            'status' => $action->status,
            'hostnames' => $hostnames,
        ])->json('body.rules.0');

        return $this->transformPartialResponseToRules($hostnames, $response);
    }

    public function modify(string $profilePk, ?int $folderPk, array $hostnames, Action $action): \Rapkis\Controld\Responses\CustomRules
    {
        $response = $this->client->put("profiles/{$profilePk}/rules", [
            'group' => $folderPk,
            'do' => $action->do,
            'via' => $action->via,
            'status' => $action->status,
            'hostnames' => $hostnames,
        ])->json('body.rules.0');

        return $this->transformPartialResponseToRules($hostnames, $response);
    }

    public function delete(string $profilePk, string $hostname): bool
    {
        $this->client->delete("profiles/{$profilePk}/rules/{$hostname}");

        return true;
    }

    /**
     * $response contains a single data point for all provided hostnames
     * therefore PK's are missing and status, do, via, ttl are not nested in the action property
     * we make sure to format it to consistent objects
     */
    protected function transformPartialResponseToRules(array $hostnames, array $response): \Rapkis\Controld\Responses\CustomRules
    {
        $result = new \Rapkis\Controld\Responses\CustomRules();

        foreach (array_reverse($hostnames) as $key => $hostname) {
            $rule = [
                'PK' => $hostname,
                'group' => $response['group'] ?? 0,
                'order' => $response['order'] - $key,
                'action' => [
                    'status' => $response['status'],
                    'do' => $response['do'],
                    'via' => $response['via'] ?? null,
                    'ttl' => $response['ttl'] ?? null,
                ],
            ];

            $rule = $this->rule->make($rule);
            $result[$rule->pk] = $rule;
        }

        return $result->reverse();
    }
}
