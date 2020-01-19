<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\User;

use Avency\Gitea\Client;

/**
 * Users Repositories Trait
 */
trait RepositoriesTrait
{
    /**
     * @return array
     */
    public function getRepositories(): array
    {
        $response = $this->client->request(self::BASE_URI . '/repos');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getStarredRepositories(): array
    {
        $response = $this->client->request(self::BASE_URI . '/starred');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return bool
     */
    public function checkStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName);

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return bool
     */
    public function addStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName, 'PUT');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return bool
     */
    public function deleteStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName, 'DELETE');

        return true;
    }

    /**
     * @return array
     */
    public function getSubscriptions(): array
    {
        $response = $this->client->request(self::BASE_URI . '/subscriptions');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
