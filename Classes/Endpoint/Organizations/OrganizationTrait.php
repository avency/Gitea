<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Organization Trait
 */
trait OrganizationTrait
{
    /**
     * @param string $organization
     * @return array
     */
    public function get(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $username
     * @param string|null $description
     * @param string|null $fullName
     * @param string|null $location
     * @param bool|null $repoAdminChangeTeamAccess
     * @param string|null $visibility
     * @param string|null $website
     * @return array
     */
    public function create(
        string $username,
        string $description = null,
        string $fullName = null,
        string $location = null,
        bool $repoAdminChangeTeamAccess = null,
        string $visibility = null, // public, limited, private
        string $website = null
    ): array
    {
        $options['json'] = [
            'username' => $username,
            'description' => $description,
            'full_name' => $fullName,
            'location' => $location,
            'repo_admin_change_team_access' => $repoAdminChangeTeamAccess,
            'visibility' => $visibility,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI, 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @return bool
     */
    public function delete(string $organization): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization, 'DELETE');

        return true;
    }

    /**
     * @param string $organization
     * @param string|null $description
     * @param string|null $fullName
     * @param string|null $location
     * @param bool|null $repoAdminChangeTeamAccess
     * @param string|null $visibility
     * @param string|null $website
     * @return array
     */
    public function update(
        string $organization,
        string $description = null,
        string $fullName = null,
        string $location = null,
        bool $repoAdminChangeTeamAccess = null,
        string $visibility = null, // public, limited, private
        string $website = null
    ): array
    {
        $options['json'] = [
            'description' => $description,
            'full_name' => $fullName,
            'location' => $location,
            'repo_admin_change_team_access' => $repoAdminChangeTeamAccess,
            'visibility' => $visibility,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
