<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Users Trait
 */
trait UsersTrait
{
    /**
     * @return array
     */
    public function getCurrentUserOrganizations(): array
    {
        $response = $this->client->request('/user/orgs');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getUserOrganizations(string $username): array
    {
        $response = $this->client->request('/users/' . $username . '/orgs');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
