<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;
use Avency\Gitea\Endpoint\Organizations\HooksTrait;
use Avency\Gitea\Endpoint\Organizations\MembersTrait;
use Avency\Gitea\Endpoint\Organizations\OrganizationTrait;
use Avency\Gitea\Endpoint\Organizations\RepositoriesTrait;
use Avency\Gitea\Endpoint\Organizations\TeamsTrait;
use Avency\Gitea\Endpoint\Organizations\UsersTrait;

/**
 * Organizations endpoint
 */
class Organizations extends AbstractEndpoint implements EndpointInterface
{
    use HooksTrait;
    use MembersTrait;
    use OrganizationTrait;
    use RepositoriesTrait;
    use TeamsTrait;
    use UsersTrait;

    const BASE_URI = '/orgs';

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
