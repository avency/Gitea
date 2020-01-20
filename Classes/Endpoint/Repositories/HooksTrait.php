<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Hooks Trait
 */
trait HooksTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getHooks(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $type
     * @param array $config
     * @param bool|null $active
     * @param string|null $branchFilter
     * @param array|null $events
     * @return array
     */
    public function addHook(
        string $owner,
        string $repositoryName,
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

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getGitHooks(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getGitHook(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteGitHook(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string $content
     * @return array
     */
    public function updateGitHook(string $owner, string $repositoryName, int $id, string $content): array
    {
        $options['json'] = [
            'content' => $content
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getHook(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteHook(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param array|null $config
     * @param bool|null $active
     * @param string|null $branchFilter
     * @param array|null $events
     * @return array
     */
    public function updateHook(
        string $owner,
        string $repositoryName,
        int $id,
        array $config = null,
        bool $active = null,
        string $branchFilter = null,
        array $events = null
    ): array
    {
        $options['json'] = [
            'config' => $config,
            'active' => $active,
            'branch_filter' => $branchFilter,
            'events' => $events,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function testHook(
        string $owner,
        string $repositoryName,
        int $id
    ): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id . '/tests', 'POST');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
