<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Times Trait
 */
trait TimesTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return array|null
     */
    public function getTimes(string $owner, string $repositoryName, int $index): ?array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return bool
     */
    public function deleteAllTimes(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times', 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param int $id
     * @return bool
     */
    public function deleteTime(string $owner, string $repositoryName, int $index, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param int $time
     * @param string|null $username
     * @param \DateTime|null $createdDate
     * @return array
     */
    public function addTime(
        string $owner,
        string $repositoryName,
        int $index,
        int $time,
        string $username = null,
        \DateTime $createdDate = null
    ): array
    {
        $options['json'] = [
            'time' => $time,
            'user_name' => $username,
            'created' => $createdDate ? $createdDate->format(\DateTime::ATOM) : null,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
