<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;
use Avency\Gitea\Endpoint\Users\TokensTrait;
use Avency\Gitea\Endpoint\Users\UsersTrait;

/**
 * Users endpoint
 */
class Users extends AbstractEndpoint implements EndpointInterface
{
    use TokensTrait;
    use UsersTrait;

    const BASE_URI = '/users';

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
}
