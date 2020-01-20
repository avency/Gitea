<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Organizations;

use Avency\Gitea\Client;

/**
 * Organizations Members Trait
 */
trait MembersTrait
{
    /**
     * @param string $organization
     * @return array
     */
    public function getMembers(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/members');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $username
     * @return bool
     */
    public function checkMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/members/' . $username);

        return true;
    }

    /**
     * @param string $organization
     * @param string $username
     * @return bool
     */
    public function deleteMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/members/' . $username, 'DELETE');

        return true;
    }

    /**
     * @param string $organization
     * @return array
     */
    public function getPublicMembers(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/public_members');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $organization
     * @param string $username
     * @return bool
     */
    public function checkPublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username);

        return true;
    }

    /**
     * @param string $organization
     * @param string $username
     * @return bool
     */
    public function addPublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username, 'PUT');

        return true;
    }

    /**
     * @param string $organization
     * @param string $username
     * @return bool
     */
    public function deletePublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username, 'DELETE');

        return true;
    }
}
