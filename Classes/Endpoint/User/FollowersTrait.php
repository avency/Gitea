<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\User;

use Avency\Gitea\Client;

/**
 * Users Followers Trait
 */
trait FollowersTrait
{
    /**
     * @return array
     */
    public function getFollowers(): array
    {
        $response = $this->client->request(self::BASE_URI . '/followers');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getFollowing(): array
    {
        $response = $this->client->request(self::BASE_URI . '/following');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @return bool
     */
    public function checkFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username);

        return true;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function addFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username, 'PUT');

        return true;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function deleteFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username, 'DELETE');

        return true;
    }
}
