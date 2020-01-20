<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Issues;

use Avency\Gitea\Client;

/**
 * Issues Comments Trait
 */
trait CommentsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function getComments(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return bool
     */
    public function deleteComment(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id, 'DELETE');

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string $body
     * @return array
     */
    public function updateComment(string $owner, string $repositoryName, int $id, string $body): array
    {
        $options['json'] = [
            'body' => $body
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id, 'PATCH', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @return array
     */
    public function getCommentReactions(string $owner, string $repositoryName, int $id): array
    {
        $options['json'] = [
            'body' => $body
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string $reaction
     * @return array
     */
    public function addCommentReaction(string $owner, string $repositoryName, int $id, string $reaction): array
    {
        $options['json'] = [
            'content' => $reaction
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $id
     * @param string $reaction
     * @return bool
     */
    public function deleteCommentReaction(string $owner, string $repositoryName, int $id, string $reaction): bool
    {
        $options['json'] = [
            'content' => $reaction
        ];

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions', 'DELETE', $options);

        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @return array
     */
    public function getIssueComments(string $owner, string $repositoryName, int $index): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/comments');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param int $index
     * @param string $body
     * @return array
     */
    public function addIssueComment(string $owner, string $repositoryName, int $index, string $body): array
    {
        $options['json'] = [
            'body' => $body
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/comments', 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
