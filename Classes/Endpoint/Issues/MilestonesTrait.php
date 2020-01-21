<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Milestones Trait
 */
trait MilestonesTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getMilestones(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $title
     * @param string|null $description
     * @param \DateTime|null $dueDate
     * @return array
     */
    public function addMilestone(
        string $owner,
        string $repositoryName,
        string $title,
        string $description = null,
        \DateTime $dueDate = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'description' => $description,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getMilestone(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteMilestone(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string|null $title
     * @param string|null $description
     * @param \DateTime|null $dueDate
     * @param string|null $state
     * @return array
     */
    public function updateMilestone(
        string $owner,
        string $repositoryName,
        int $id,
        string $title = null,
        string $description = null,
        \DateTime $dueDate = null,
        string $state = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'description' => $description,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
            'state' => $state,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
