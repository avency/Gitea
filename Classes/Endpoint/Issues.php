<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;
use Avency\Gitea\Endpoint\Issues\CommentsTrait;
use Avency\Gitea\Endpoint\Issues\IssuesTrait;
use Avency\Gitea\Endpoint\Issues\IssueTrait;
use Avency\Gitea\Endpoint\Issues\LabelsTrait;
use Avency\Gitea\Endpoint\Issues\MilestonesTrait;
use Avency\Gitea\Endpoint\Issues\ReactionsTrait;
use Avency\Gitea\Endpoint\Issues\StopwatchTrait;
use Avency\Gitea\Endpoint\Issues\SubscriptionsTrait;
use Avency\Gitea\Endpoint\Issues\TimesTrait;

/**
 * Issues endpoint
 */
class Issues extends AbstractEndpoint implements EndpointInterface
{
    use CommentsTrait;
    use IssueTrait;
    use IssuesTrait;
    use LabelsTrait;
    use MilestonesTrait;
    use ReactionsTrait;
    use StopwatchTrait;
    use SubscriptionsTrait;
    use TimesTrait;

    const BASE_URI = '/repos';

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
