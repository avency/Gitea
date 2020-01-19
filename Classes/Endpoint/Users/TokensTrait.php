<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Users;

use Avency\Gitea\Client;

/**
 * Users Tokens Trait
 */
trait TokensTrait
{
    /**
     * @param string $username
     * @return array
     */
    public function getTokens(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' .$username . '/tokens');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @param string $name
     * @return array
     */
    public function addToken(string $username, string $name): array
    {
        $options['json'] = [
            'name' => $name
        ];

        $response = $this->client->request(self::BASE_URI . '/' .$username . '/tokens', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @param int $token
     * @return bool
     */
    public function deleteToken(string $username, int $token): bool
    {
        $this->client->request(self::BASE_URI . '/' .$username . '/tokens/' . $token, 'DELETE');

        return true;
    }
}
