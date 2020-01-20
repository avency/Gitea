<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Releases Trait
 */
trait ReleasesTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getReleases(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $tagName
     * @param string|null $body
     * @param bool|null $draft
     * @param string|null $name
     * @param bool|null $prerelease
     * @param string|null $targetCommitish
     * @return array
     */
    public function createRelease(
        string $owner,
        string $repositoryName,
        string $tagName,
        string $body = null,
        bool $draft = null,
        string $name = null,
        bool $prerelease = null,
        string $targetCommitish = null
    ): array
    {
        $options['json'] = [
            'tag_name' => $tagName,
            'body' => $body,
            'draft' => $draft,
            'name' => $name,
            'prerelease' => $prerelease,
            'target_commitish' => $targetCommitish,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getRelease(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteRelease(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string|null $tagName
     * @param string|null $body
     * @param bool|null $draft
     * @param string|null $name
     * @param bool|null $prerelease
     * @param string|null $targetCommitish
     * @return array
     */
    public function updateRelease(
        string $owner,
        string $repositoryName,
        int $id,
        string $tagName = null,
        string $body = null,
        bool $draft = null,
        string $name = null,
        bool $prerelease = null,
        string $targetCommitish = null
    ): array
    {
        $options['json'] = [
            'tag_name' => $tagName,
            'body' => $body,
            'draft' => $draft,
            'name' => $name,
            'prerelease' => $prerelease,
            'target_commitish' => $targetCommitish,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getReleaseAssets(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string $name
     * @return array
     */
    public function updateReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId, string $name): array
    {
        $options['json'] = [
            'name' => $name
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
