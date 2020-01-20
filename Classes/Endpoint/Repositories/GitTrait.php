<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Git Trait
 */
trait GitTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @return array
     */
    public function getBlob(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/blobs/' . $sha);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @return array
     */
    public function getCommit(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/commits/' . $sha);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getRefs(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/refs');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $ref
     * @return array
     */
    public function getRef(string $owner, string $repositoryName, string $ref): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/refs/' . $ref);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @return array
     */
    public function getTag(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/tags/' . $sha);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $sha
     * @param bool|null $recursive
     * @param int|null $page
     * @param int|null $perPage
     * @return array
     */
    public function getTree(
        string $owner,
        string $repositoryName,
        string $sha,
        bool $recursive = null,
        int $page = null,
        int $perPage = null
    ): array
    {
        $options['query'] = [
            'recursive' => $recursive,
            'page' => $page,
            'per_page' => $perPage,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/trees/' . $sha, 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
