<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Pulls Trait
 */
trait PullsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int|null $page
     * @param string|null $state
     * @param string|null $sort
     * @param int|null $milestone
     * @param array|null $lables
     * @return array
     */
    public function getPulls(
        string $owner,
        string $repositoryName,
        int $page = null,
        string $state = null,
        string $sort = null,
        int $milestone = null,
        array $lables = null
    ): array
    {
        $options['query'] = [
            'page' => $page,
            'state' => $state,
            'sort' => $sort,
            'milestone' => $milestone,
            'lables' => $lables,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls', 'GET', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $assignee
     * @param string $base
     * @param string $head
     * @param array|null $assignees
     * @param string|null $title
     * @param string|null $body
     * @param \DateTime|null $dueDate
     * @param array|null $labels
     * @param int|null $milestone
     * @return array
     */
    public function createPull(
        string $owner,
        string $repositoryName,
        string $assignee,
        string $base,
        string $head,
        string $title,
        array $assignees = null,
        string $body = null,
        \DateTime $dueDate = null,
        array $labels = null,
        int $milestone = null
    ): array
    {
        $options['json'] = [
            'assignee' => $assignee,
            'base' => $base,
            'head' => $head,
            'assignees' => $assignees,
            'title' => $title,
            'body' => $body,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
            'labels' => $labels,
            'milestone' => $milestone,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return array
     */
    public function getPull(
        string $owner,
        string $repositoryName,
        int $index
    ): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index, 'GET');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string|null $assignee
     * @param string|null $title
     * @param string|null $state
     * @param array|null $assignees
     * @param string|null $body
     * @param \DateTime|null $dueDate
     * @param bool|null $unsetDueDate
     * @param array|null $labels
     * @param int|null $milestone
     * @return array
     */
    public function updatePull(
        string $owner,
        string $repositoryName,
        int $index,
        string $assignee = null,
        string $title = null,
        string $state = null,
        array $assignees = null,
        string $body = null,
        \DateTime $dueDate = null,
        bool $unsetDueDate = null,
        array $labels = null,
        int $milestone = null
    ): array
    {
        $options['json'] = [
            'assignee' => $assignee,
            'assignees' => $assignees,
            'title' => $title,
            'state' => $state,
            'body' => $body,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
            'unsetDueDate' => $unsetDueDate,
            'labels' => $labels,
            'milestone' => $milestone,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return bool
     */
    public function checkMerged(
        string $owner,
        string $repositoryName,
        int $index
    ): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index . '/merge', 'GET');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string $do
     * @param string|null $mergeMessage
     * @param string|null $mergeTitle
     * @return bool
     */
    public function mergePull(
        string $owner,
        string $repositoryName,
        int $index,
        string $do,
        string $mergeMessage = null,
        string $mergeTitle = null
    ): bool
    {
        $options['json'] = [
            'Do' => $do,
            'MergeMessageField' => $mergeMessage,
            'MergeTitleField' => $mergeTitle,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index . '/merge', 'POST', $options);

        return true;
    }
}
