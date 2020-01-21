<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Stopwatch Trait
 */
trait StopwatchTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return bool
     */
    public function startStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/start', 'POST');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return bool
     */
    public function stopStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/stop', 'POST');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return bool
     */
    public function deleteStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/delete', 'DELETE');

        return true;
    }
}
