<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\User;

use Avency\Gitea\Client;

/**
 * Users User Trait
 */
trait UserTrait
{
    /**
     * @return array
     */
    public function get(): array
    {
        $response = $this->client->request(self::BASE_URI);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getEmails(): array
    {
        $response = $this->client->request(self::BASE_URI . '/emails');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param array $emails
     * @return array
     */
    public function addEmails(array $emails): array
    {
        $options['json'] = [
            'emails' => $emails
        ];

        $response = $this->client->request(self::BASE_URI . '/emails', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param array $emails
     * @return bool
     */
    public function deleteEmails(array $emails): bool
    {
        $options['json'] = [
            'emails' => $emails
        ];

        $this->client->request(self::BASE_URI . '/emails', 'DELETE', $options);

        return true;
    }

    /**
     * @return array
     */
    public function getStopwatches(): array
    {
        $response = $this->client->request(self::BASE_URI . '/stopwatches');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getTeams(): array
    {
        $response = $this->client->request(self::BASE_URI . '/teams');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getTimes(): array
    {
        $response = $this->client->request(self::BASE_URI . '/times');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
