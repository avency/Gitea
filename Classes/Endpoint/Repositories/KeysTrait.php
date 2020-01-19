<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Keys Trait
 */
trait KeysTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int|null $keyId
     * @param string|null $fingerprint
     * @return array
     */
    public function getKeys(string $owner, string $repositoryName, int $keyId = null, string $fingerprint = null): array
    {
        $options['query'] = [
            'key_id' => $keyId,
            'fingerprint' => $fingerprint
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys', 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $title
     * @param string $key
     * @param bool|null $readOnly
     * @return array
     */
    public function addKey(
        string $owner,
        string $repositoryName,
        string $title,
        string $key,
        bool $readOnly = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'key' => $key,
            'read_only' => $readOnly,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys', 'POST', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $keyId
     * @return array
     */
    public function getKey(string $owner, string $repositoryName, int $keyId): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys/' . $keyId);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $keyId
     * @return bool
     */
    public function deleteKey(string $owner, string $repositoryName, int $keyId): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys/' . $keyId, 'DELETE');

        return true;
    }
}
