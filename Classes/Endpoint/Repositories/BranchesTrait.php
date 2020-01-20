<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Branches Trait
 */
trait BranchesTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getBranches(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/branches');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param $branch
     * @return array
     */
    public function getBranche(string $owner, string $repositoryName, string $branch): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/branches/' . $branch);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
