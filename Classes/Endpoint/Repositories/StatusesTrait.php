<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Statuses Trait
 */
trait StatusesTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @param int|null $page
     * @param int|null $sort
     * @param int|null $state
     * @return array
     */
    public function getStatuses(
        string $owner,
        string $repositoryName,
        string $sha,
        int $page = null,
        int $sort = null,
        int $state = null
    ): array
    {
        $options['query'] = [
            'page' => $page,
            'sort' => $sort,
            'state' => $state,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/statuses/' . $sha, 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @param string $state // pending, success, error, failure, warning
     * @param string|null $description
     * @param string|null $context
     * @param string|null $targetUrl
     * @return array
     */
    public function createStatus(
        string $owner,
        string $repositoryName,
        string $sha,
        string $state,
        string $description = null,
        string $context = null,
        string $targetUrl = null
    ): array
    {
        $options['json'] = [
            'state' => $state,
            'description' => $description,
            'context' => $context,
            'target_url' => $targetUrl,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/statuses/' . $sha, 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
