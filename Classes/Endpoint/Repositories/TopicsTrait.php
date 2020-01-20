<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Topics Trait
 */
trait TopicsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getTopics(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param array $topics
     * @return bool
     */
    public function replaceTopics(string $owner, string $repositoryName, array $topics): bool
    {
        $options['json'] = [
            'topics' => $topics
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics', 'PUT', $options);

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $topic
     * @return bool
     */
    public function addTopic(string $owner, string $repositoryName, string $topic): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics/' . $topic, 'PUT');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $topic
     * @return bool
     */
    public function deleteTopic(string $owner, string $repositoryName, string $topic): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics/' . $topic, 'DELETE');

        return true;
    }
}
