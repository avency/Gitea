<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Miscellaneous endpoint
 */
class Miscellaneous implements EndpointInterface
{
    const BASE_URI = 'api/v1';

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
     * @return string
     */
    public function version(): string
    {
        $response = $this->client->request(self::BASE_URI . '/version');
        return \GuzzleHttp\json_decode($response->getBody(), true)['version'];
    }
}
