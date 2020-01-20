<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Users;

use Avency\Gitea\Client;

/**
 * Users Users Trait
 */
trait UsersTrait
{
    /**
     * @param string $username
     * @return array
     */
    public function get(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $searchTerm
     * @param int|null $id
     * @param int|null $limit
     * @return array
     */
    public function search(string $searchTerm, int $id = null, int $limit = null): array
    {
        $options['query'] = [
            'q' => $searchTerm,
            'id' => $id,
            'limit' => $limit,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/search', 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @param string $followee
     * @return bool
     */
    public function checkFollowing(string $username, string $followee): bool
    {
        $this->client->request(self::BASE_URI . '/' . $username . '/following/' . $followee);

        return true;
    }

    /**
     * @param string $username
     * @return array
     */
    public function getFollowers(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/followers');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getFollowing(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/following');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getGPGKeys(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/gpg_keys');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getHeatmap(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/heatmap');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getKeys(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/keys');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getRepositories(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/repos');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getStarred(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/starred');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return array
     */
    public function getSubscriptions(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/subscriptions');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getTimes(string $username, string $owner, string $repositoryName): array
    {
        $response = $this->client->request('/repos/' . $owner . '/' . $repositoryName . '/times/' . $username);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
