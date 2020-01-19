<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Teams Trait
 */
trait TeamsTrait
{
    /**
     * @param string $organization
     * @return array
     */
    public function getTeams(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $name
     * @param bool|null $canCreateOrgRepo
     * @param string|null $description
     * @param bool|null $includesAllRepositories
     * @param string|null $permission
     * @param array|null $units
     * @return array
     */
    public function createTeam(
        string $organization,
        string $name,
        bool $canCreateOrgRepo = null,
        string $description = null,
        bool $includesAllRepositories = null,
        string $permission = null, // read, write, admin
        array $units = null // repo.code, repo.issues, repo.ext_issues, repo.wiki, repo.pulls, repo.releases, repo.ext_wiki
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'can_create_org_repo' => $canCreateOrgRepo,
            'description' => $description,
            'includes_all_repositories' => $includesAllRepositories,
            'permission' => $permission,
            'units' => $units,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $searchTerm
     * @param bool|null $includeDesc
     * @param int|null $limit
     * @param int|null $page
     * @return array
     */
    public function searchTeams(
        string $organization,
        string $searchTerm,
        bool $includeDesc = null,
        int $limit = null,
        int $page = null
    ): array
    {
        $options['query'] = [
            'searchTerm' => $searchTerm,
            'includeDesc' => $includeDesc,
            'limit' => $limit,
            'page' => $page,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams/search', 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTeam(int $id): array
    {
        $response = $this->client->request('/teams/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTeam(int $id): bool
    {
        $this->client->request('/teams/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param bool|null $canCreateOrgRepo
     * @param string|null $description
     * @param bool|null $includesAllRepositories
     * @param string|null $permission
     * @param array|null $units
     * @return array
     */
    public function updateTeam(
        int $id,
        string $name,
        bool $canCreateOrgRepo = null,
        string $description = null,
        bool $includesAllRepositories = null,
        string $permission = null, // read, write, admin
        array $units = null // repo.code, repo.issues, repo.ext_issues, repo.wiki, repo.pulls, repo.releases, repo.ext_wiki
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'can_create_org_repo' => $canCreateOrgRepo,
            'description' => $description,
            'includes_all_repositories' => $includesAllRepositories,
            'permission' => $permission,
            'units' => $units,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request('/teams/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTeamMembers(int $id): array
    {
        $response = $this->client->request('/teams/' . $id . '/members');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @param string $username
     * @return array
     */
    public function getTeamMember(int $id, string $username): array
    {
        $response = $this->client->request('/teams/' . $id . '/members/' . $username);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @param string $username
     * @return bool
     */
    public function addTeamMember(int $id, string $username): bool
    {
        $this->client->request('/teams/' . $id . '/members/' . $username, 'PUT');

        return true;
    }

    /**
     * @param int $id
     * @param string $username
     * @return bool
     */
    public function deleteTeamMember(int $id, string $username): bool
    {
        $this->client->request('/teams/' . $id . '/members/' . $username, 'DELETE');

        return true;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTeamRepositories(int $id): array
    {
        $response = $this->client->request('/teams/' . $id . '/repos');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $id
     * @param $organization
     * @param $repositoryName
     * @return bool
     */
    public function addTeamRepository(int $id, $organization, $repositoryName): bool
    {
        $this->client->request('/teams/' . $id . '/repos/' . $organization . '/' . $repositoryName, 'PUT');

        return true;
    }

    /**
     * @param int $id
     * @param $organization
     * @param $repositoryName
     * @return bool
     */
    public function deleteTeamRepository(int $id, $organization, $repositoryName): bool
    {
        $this->client->request('/teams/' . $id . '/repos/' . $organization . '/' . $repositoryName, 'DELETE');

        return true;
    }
}
