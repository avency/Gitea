<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Subscriptions Trait
 */
trait SubscriptionsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return array|null
     */
    public function getSubscriptions(string $owner, string $repositoryName, int $index): ?array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string $username
     * @return bool
     */
    public function deleteSubscription(string $owner, string $repositoryName, int $index, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions/' . $username, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string $username
     * @return bool
     */
    public function addSubscription(string $owner, string $repositoryName, int $index, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions/' . $username, 'PUT');

        return true;
    }
}
