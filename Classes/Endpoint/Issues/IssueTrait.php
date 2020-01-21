<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Issue Trait
 */
trait IssueTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return array
     */
    public function get(string $owner, string $repositoryName, int $index): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string|null $assignee
     * @param array|null $assignees
     * @param string|null $body
     * @param \DateTime|null $dueDate
     * @param int|null $milestone
     * @param string|null $state
     * @param string|null $title
     * @param bool|null $unsetDueDate
     * @return array
     */
    public function update(
        string $owner,
        string $repositoryName,
        int $index,
        string $assignee = null,
        array $assignees = null,
        string $body = null,
        \DateTime $dueDate = null,
        int $milestone = null,
        string $state = null,
        string $title = null,
        bool $unsetDueDate = null
    ): array
    {
        $options['json'] = [
            'assignee' => $assignee,
            'assignees' => $assignees,
            'body' => $body,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
            'mileston' => $milestone,
            'state' => $state,
            'title' => $title,
            'unset_due_date' => $unsetDueDate,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string|null $assignee
     * @param array|null $assignees
     * @param string|null $body
     * @param \DateTime|null $dueDate
     * @param int|null $milestone
     * @param string|null $state
     * @param string|null $title
     * @param bool|null $unsetDueDate
     * @return array
     */
    public function setDeadline(
        string $owner,
        string $repositoryName,
        int $index,
        \DateTime $dueDate
    ): array
    {
        $options['json'] = [
            'due_date' => $dueDate->format(\DateTime::ATOM),
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/deadline', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
