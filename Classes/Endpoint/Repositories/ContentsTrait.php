<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint\Repositories;

use Avency\Gitea\Client;

/**
 * Repositories Contents Trait
 */
trait ContentsTrait
{
    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string|null $ref
     * @return array
     */
    public function getContents(string $owner, string $repositoryName, string $ref = null): array
    {
        $options['query'] = [
            'ref' => $ref
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents');

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $filepath
     * @param string|null $ref
     * @return array
     */
    public function getContent(string $owner, string $repositoryName, string $filepath, string $ref = null): array
    {
        $options['query'] = [
            'ref' => $ref
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $filepath
     * @param string $sha
     * @param string $content
     * @param string|null $authorEmail
     * @param string|null $authorName
     * @param string|null $branch
     * @param string|null $committerEmail
     * @param string|null $committerName
     * @param \DateTime|null $authorDate
     * @param \DateTime|null $committerDate
     * @param string|null $message
     * @param string|null $newBranch
     * @return array
     */
    public function updateContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $sha,
        string $content,
        string $authorEmail = null,
        string $authorName = null,
        string $branch = null,
        string $committerEmail = null,
        string $committerName = null,
        \DateTime $authorDate = null,
        \DateTime $committerDate = null,
        string $message = null,
        string $newBranch = null
    ): array
    {
        $options['json'] = [
            'sha' => $sha,
            'content' => base64_encode($content),
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate ? $authorDate->format(\DateTime::ATOM) : null,
                'committer' => $committerDate ? $committerDate->format(\DateTime::ATOM) : null,
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'PUT', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $filepath
     * @param string $content
     * @param string|null $authorEmail
     * @param string|null $authorName
     * @param string|null $branch
     * @param string|null $committerEmail
     * @param string|null $committerName
     * @param \DateTime|null $authorDate
     * @param \DateTime|null $committerDate
     * @param string|null $message
     * @param string|null $newBranch
     * @return array
     */
    public function addContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $content,
        string $authorEmail = null,
        string $authorName = null,
        string $branch = null,
        string $committerEmail = null,
        string $committerName = null,
        \DateTime $authorDate = null,
        \DateTime $committerDate = null,
        string $message = null,
        string $newBranch = null
    ): array
    {
        $options['json'] = [
            'content' => base64_encode($content),
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate ? $authorDate->format(\DateTime::ATOM) : null,
                'committer' => $committerDate ? $committerDate->format(\DateTime::ATOM) : null,
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'POST', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $filepath
     * @param string $sha
     * @param string $content
     * @param string|null $authorEmail
     * @param string|null $authorName
     * @param string|null $branch
     * @param string|null $committerEmail
     * @param string|null $committerName
     * @param \DateTime|null $authorDate
     * @param \DateTime|null $committerDate
     * @param string|null $message
     * @param string|null $newBranch
     * @return array
     */
    public function deleteContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $sha,
        string $authorEmail = null,
        string $authorName = null,
        string $branch = null,
        string $committerEmail = null,
        string $committerName = null,
        \DateTime $authorDate = null,
        \DateTime $committerDate = null,
        string $message = null,
        string $newBranch = null
    ): array
    {
        $options['json'] = [
            'sha' => $sha,
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate ? $authorDate->format(\DateTime::ATOM) : null,
                'committer' => $committerDate ? $committerDate->format(\DateTime::ATOM) : null,
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'DELETE', $options);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param string $filepath
     * @return array
     */
    public function getEditorConfig(string $owner, string $repositoryName, string $filepath): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/editorconfig/' . $filepath);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return string
     */
    public function getRawContent(string $owner, string $repositoryName, string $filepath): string
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/raw/' . $filepath);

        return (string)$response->getBody();
    }
}
