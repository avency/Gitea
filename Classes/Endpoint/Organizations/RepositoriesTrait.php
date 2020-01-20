<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Repositories Trait
 */
trait RepositoriesTrait
{
    /**
     * @param string $organization
     * @return array
     */
    public function getRepos(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/repos');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $name
     * @param bool|null $autoInit
     * @param string|null $description
     * @param string|null $gitignores
     * @param string|null $issueLabels
     * @param string|null $license
     * @param bool|null $private
     * @param string|null $readme
     * @return array
     */
    public function createRepo(
        string $organization,
        string $name,
        bool $autoInit = null,
        string $description = null,
        string $gitignores = null,
        string $issueLabels = null,
        string $license = null,
        bool $private = null,
        string $readme = null
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'auto_init' => $autoInit,
            'description' => $description,
            'gitignores' => $gitignores,
            'issue_labels' => $issueLabels,
            'license' => $license,
            'private' => $private,
            'readme' => $readme,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request('/org/' . $organization . '/repos', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
