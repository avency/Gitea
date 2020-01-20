<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\User;

use Avency\Gitea\Client;

/**
 * Users Keys Trait
 */
trait KeysTrait
{
    /**
     * @return array
     */
    public function getGPGKeys(): array
    {
        $response = $this->client->request(self::BASE_URI . '/gpg_keys');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $key
     * @return array
     */
    public function addGPGKey(string $key): array
    {
        $options['json'] = [
            'armored_public_key' => $key
        ];

        $response = $this->client->request(self::BASE_URI . '/gpg_keys', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getGPGKey(int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/gpg_keys/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteGPGKey(int $id): bool
    {
        $this->client->request(self::BASE_URI . '/gpg_keys/' . $id, 'DELETE');

        return true;
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        $response = $this->client->request(self::BASE_URI . '/keys');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $title
     * @param string $key
     * @param bool|null $readOnly
     * @return array
     */
    public function addKey(string $title, string $key, bool $readOnly = null): array
    {
        $options['json'] = [
            'key' => $key,
            'read_only' => $readOnly,
            'title' => $title,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/keys', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getKey(int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/keys/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteKey(int $id): bool
    {
        $this->client->request(self::BASE_URI . '/keys/' . $id, 'DELETE');

        return true;
    }
}
