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
        $array = array_map(function($value) {
            return is_array($value) ? $this->removeNullValues($value) : $value;
        }, $array);

        return array_filter($array, function($value) {
            return !is_null($value) && !(is_array($value) && empty($value));
        });
    }
}
