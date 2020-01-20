<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Hooks Trait
 */
trait HooksTrait
{
    /**
     * @param string $organization
     * @return array
     */
    public function getHooks(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $type
     * @param array $config
     * @param bool|null $active
     * @param string|null $branchFilter
     * @param array|null $events
     * @return array
     */
    public function createHook(
        string $organization,
        string $type,
        array $config,
        bool $active = null,
        string $branchFilter = null,
        array $events = null
    ): array
    {
        $options['json'] = [
            'type' => $type,
            'config' => $config,
            'active' => $active,
            'branch_filter' => $branchFilter,
            'events' => $events,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param int $id
     * @return array
     */
    public function getHook(string $organization, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param int $id
     * @return bool
     */
    public function deleteHook(string $organization, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $organization
     * @param int $id
     * @param bool $active
     * @param string|null $branchFilter
     * @param array|null $config
     * @param array|null $events
     * @return array
     */
    public function updateHook(
        string $organization,
        int $id,
        bool $active,
        string $branchFilter = null,
        array $config = null,
        array $events = null
    ): array
    {
        $options['json'] = [
            'active' => $active,
            'branch_filter' => $branchFilter,
            'config' => $config,
            'events' => $events,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
