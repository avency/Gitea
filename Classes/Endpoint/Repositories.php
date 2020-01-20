<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Repositories endpoint
 */
class Repositories extends AbstractEndpoint implements EndpointInterface
{
    const BASE_URI = 'api/v1/repos';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $cloneAddr
     * @param string $repoName
     * @param int $uid
     * @param string|null $authPassword
     * @param string|null $authUsername
     * @param string $description
     * @param bool $issues
     * @param bool $labels
     * @param bool $milestones
     * @param bool $mirror
     * @param bool $private
     * @param bool $pullRequests
     * @param bool $releases
     * @param bool $wiki
     * @return array
     */
    public function migrate(
        string $cloneAddr,
        string $repoName,
        int $uid,
        ?string $authPassword = null,
        ?string $authUsername = null,
        string $description = '',
        bool $issues = true,
        bool $labels = true,
        bool $milestones = true,
        bool $mirror = true,
        bool $private = true,
        bool $pullRequests = true,
        bool $releases = true,
        bool $wiki = true
    ): array
    {
        $options = [
            'json' => [
                'clone_addr' => $cloneAddr,
                'repo_name' => $repoName,
                'uid' => $uid,
                'auth_password' => $authPassword,
                'auth_username' => $authUsername,
                'description' => $description,
                'issues' => $issues,
                'labels' => $labels,
                'milestones' => $milestones,
                'mirror' => $mirror,
                'private' => $private,
                'pull_requests' => $pullRequests,
                'releases' => $releases,
                'wiki' => $wiki,
            ]
        ];

        $options['json'] = $this->removeNullValues($options['json']);
        $response = $this->client->request(self::BASE_URI . '/migrate', 'POST', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $query
     * @param bool|null $topic
     * @param bool|null $includeDesc
     * @param int|null $uid
     * @param int|null $priorityOwnerId
     * @param int|null $starredBy
     * @param bool|null $private
     * @param bool|null $template
     * @param int|null $page
     * @param int|null $limit
     * @param string|null $mode
     * @param bool|null $exclusive
     * @param string|null $sort
     * @param string|null $order
     * @return array
     */
    public function search(
        string $query,
        ?bool $topic = null,
        ?bool $includeDesc = null,
        ?int $uid = null,
        ?int $priorityOwnerId = null,
        ?int $starredBy = null,
        ?bool $private = null,
        ?bool $template = null,
        ?int $page = null,
        ?int $limit = null,
        ?string $mode = null,
        ?bool $exclusive = null,
        ?string $sort = null,
        ?string $order = null
    ): array
    {
        $options['query'] = [
            'query' => $query,
            'topic' => $topic,
            'includeDesc' => $includeDesc,
            'uid' => $uid,
            'priorityOwnerId' => $priorityOwnerId,
            'starredBy' => $starredBy,
            'private' => $private,
            'template' => $template,
            'page' => $page,
            'limit' => $limit,
            'mode' => $mode,
            'exclusive' => $exclusive,
            'sort' => $sort,
            'order' => $order,
        ];
        $options['query'] = $this->removeNullValues($options['query']);
        $response = $this->client->request(self::BASE_URI . '/search', 'GET', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function get(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return bool
     */
    public function delete(string $owner, string $repositoryName): array
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName, 'DELETE');
        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function patch(string $owner, string $repositoryName, array $properties): array
    {
        $options['json'] = $properties;

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName, 'PATCH', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
