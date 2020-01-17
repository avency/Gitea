<?php

declare(strict_types=1);

namespace Avency\Gitea;

use Avency\Gitea\Endpoint\EndpointInterface;
use Avency\Gitea\Endpoint\Repositories;
use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Gitea Client
 */
class Client
{
    const AUTH_ACCESS_TOKEN = 'access_token';
    const AUTH_TOKEN = 'token';
    const AUTH_BASIC_AUTH = 'basic_auth';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param $baseUri
     * @param $authentication
     * @throws Exception
     */
    public function __construct($baseUri, $authentication)
    {
        $this->config = [
            'base_uri' => $baseUri
        ];

        $this->auth($authentication);

        $this->httpClient = new \GuzzleHttp\Client($this->config);
    }

    /**
     * @param string $api
     * @return EndpointInterface
     * @throws Exception
     */
    public function api(string $api): EndpointInterface
    {
        switch ($api) {
            case 'repositories':
                return new Repositories($this);
        }

        throw new Exception('Endpoint not found', 1579246217);
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $options
     * @return ResponseInterface
     */
    public function request(string $uri = '', string $method = 'GET', array $options = []): ResponseInterface
    {
        return $this->httpClient->request($method, $uri, $options);
    }

    /**
     * @param array $authentication
     * @throws Exception
     */
    protected function auth(array $authentication)
    {
        if (empty($authentication['type'])) {
            throw new Exception('Please add an authentication type.', 1579244392);
        }

        switch ($authentication['type']) {
            case self::AUTH_ACCESS_TOKEN:
                if (empty($authentication['auth'])) {
                    throw new Exception('Please add the access token.', 1579245994);
                }

                $this->config['query']['access_token'] = $authentication['auth'];
                break;

            case self::AUTH_BASIC_AUTH:
                if (empty($authentication['auth']['username'])) {
                    throw new Exception('Please add the username.', 1579246033);
                }
                if (empty($authentication['auth']['password'])) {
                    throw new Exception('Please add the password.', 1579246035);
                }

                $this->config['auth'] = [$authentication['auth']['username'], $authentication['auth']['password']];
                break;

            case self::AUTH_TOKEN:
                if (empty($authentication['auth'])) {
                    throw new Exception('Please add the token.', 1579246003);
                }

                $this->config['query']['token'] = $authentication['auth'];
                break;
        }
    }
}