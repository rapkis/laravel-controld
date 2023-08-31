<?php

declare(strict_types=1);

namespace Rapkis\Controld\Resources\Profiles;

use Illuminate\Http\Client\PendingRequest;
use Rapkis\Controld\Entities\Action;
use Rapkis\Controld\Factories\RuleFolderFactory;
use Rapkis\Controld\Responses\RuleFolder;

class RuleFolders
{
    public function __construct(private readonly PendingRequest $client, private readonly RuleFolderFactory $ruleFolder)
    {
    }

    public function list(string $profilePk): \Rapkis\Controld\Responses\RuleFolders
    {
        $response = $this->client->get("profiles/{$profilePk}/groups")->json('body.groups');

        $result = new \Rapkis\Controld\Responses\RuleFolders();

        foreach ($response as $folder) {
            $folder = $this->ruleFolder->make($folder);
            $result[$folder->pk] = $folder;
        }

        return $result;
    }

    public function create(string $profilePk, string $name, Action $action): RuleFolder
    {
        $response = $this->client->post("profiles/{$profilePk}/groups", [
            'name' => $name,
            'do' => $action->do,
            'via' => $action->via,
            'status' => $action->status,
        ])->json('body.groups.0');

        return $this->ruleFolder->make($response);
    }

    public function modify(string $profilePk, int $folderPk, ?string $name, Action $action): RuleFolder
    {
        $response = $this->client->put("profiles/{$profilePk}/groups/{$folderPk}", [
            'name' => $name,
            'do' => $action->do,
            'via' => $action->via,
            'status' => $action->status,
        ])->json('body.groups.0');

        return $this->ruleFolder->make($response);
    }

    public function delete(string $profilePk, int $folderPk): bool
    {
        $this->client->delete("profiles/{$profilePk}/groups/{$folderPk}");

        return true;
    }
}
