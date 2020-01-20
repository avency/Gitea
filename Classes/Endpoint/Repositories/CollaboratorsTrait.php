<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Collaborators Trait
 */
trait CollaboratorsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getCollaborators(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $collaborator
     * @return bool
     */
    public function checkCollaborator(string $owner, string $repositoryName, string $collaborator): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator);

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $collaborator
     * @param string $permission
     * @return bool
     */
    public function addCollaborator(string $owner, string $repositoryName, string $collaborator, string $permission = 'write'): bool
    {
        $options['json'] = [
            'permission' => $permission
        ];

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator, 'PUT', $options);

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $collaborator
     * @return bool
     */
    public function deleteCollaborator(string $owner, string $repositoryName, string $collaborator): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator, 'DELETE');

        return true;
    }
}
