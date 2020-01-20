<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Abstract endpoint
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * @param array $array
     * @return array
     */
    protected function removeNullValues(array $array): array
    {
        return array_filter(
            $array,
            function($value) {
                return !is_null($value);
            }
        );
    }
}
