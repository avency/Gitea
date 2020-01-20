<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;
use Avency\Gitea\Endpoint\User\RepositoriesTrait;
use Avency\Gitea\Endpoint\User\UserTrait;
use Avency\Gitea\Endpoint\User\FollowersTrait;
use Avency\Gitea\Endpoint\User\KeysTrait;

/**
 * User endpoint
 */
class User extends AbstractEndpoint implements EndpointInterface
{
    use FollowersTrait;
    use KeysTrait;
    use RepositoriesTrait;
    use UserTrait;

    const BASE_URI = '/user';

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
