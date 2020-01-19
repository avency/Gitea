<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Miscellaneous endpoint
 */
class Miscellaneous extends AbstractEndpoint implements EndpointInterface
{
    const BASE_URI = '';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string|null $text
     * @param string|null $context
     * @param string|null $mode
     * @param bool $wiki
     * @return string
     */
    public function markdown(string $text = null, string $context = null, string $mode = null, bool $wiki = true): string
    {
        $options['json'] = [
            'context' => $context,
            'mode' => $mode,
            'text' => $text,
            'wiki' => $wiki
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/markdown', 'POST', $options);
        return (string)$response->getBody();
    }

    /**
     * @param string$text
     * @return string
     */
    public function markdownRaw(string $text): string
    {
        $options['body'] = $text;
        $response = $this->client->request(self::BASE_URI . '/markdown/raw', 'POST', $options);
        return (string)$response->getBody();
    }

    /**
     * @return string
     */
    public function signingKeyGPG(): string
    {
        $response = $this->client->request(self::BASE_URI . '/signing-key.gpg');
        return (string)$response->getBody();
    }

    /**
     * @return string
     */
    public function version(): string
    {
        $response = $this->client->request(self::BASE_URI . '/version');
        return \GuzzleHttp\json_decode($response->getBody(), true)['version'];
    }
}
