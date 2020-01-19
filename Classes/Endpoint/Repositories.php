<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;
use Avency\Gitea\Endpoint\Repositories\BranchesTrait;
use Avency\Gitea\Endpoint\Repositories\CollaboratorsTrait;
use Avency\Gitea\Endpoint\Repositories\CommitsTrait;
use Avency\Gitea\Endpoint\Repositories\ContentsTrait;
use Avency\Gitea\Endpoint\Repositories\ForksTrait;
use Avency\Gitea\Endpoint\Repositories\GitTrait;
use Avency\Gitea\Endpoint\Repositories\HooksTrait;
use Avency\Gitea\Endpoint\Repositories\KeysTrait;
use Avency\Gitea\Endpoint\Repositories\PullsTrait;
use Avency\Gitea\Endpoint\Repositories\RepositoryTrait;

/**
 * Repositories endpoint
 */
class Repositories extends AbstractEndpoint implements EndpointInterface
{
    use BranchesTrait;
    use CollaboratorsTrait;
    use CommitsTrait;
    use ContentsTrait;
    use ForksTrait;
    use GitTrait;
    use HooksTrait;
    use KeysTrait;
    use PullsTrait;
    use RepositoryTrait;

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
}
