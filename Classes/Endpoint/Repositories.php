<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Repositories endpoint
 */
class Repositories implements EndpointInterface
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
     * @param $owner
     * @param $repositoryName
     * @return array
     */
    public function get($owner, $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
