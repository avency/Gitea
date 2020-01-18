<?php

declare(strict_types=1);

namespace Avency\Gitea\Endpoint;

use Avency\Gitea\Client;

/**
 * Repositories endpoint
 */
class Repositories extends AbstractEndpoint implements EndpointInterface
{
    const BASE_URI = 'api/v1/repos';

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
     * @param string $cloneAddr
     * @param string $repoName
     * @param int $uid
     * @param string|null $authPassword
     * @param string|null $authUsername
     * @param string $description
     * @param bool $issues
     * @param bool $labels
     * @param bool $milestones
     * @param bool $mirror
     * @param bool $private
     * @param bool $pullRequests
     * @param bool $releases
     * @param bool $wiki
     * @return array
     */
    public function migrate(
        string $cloneAddr,
        string $repoName,
        int $uid,
        ?string $authPassword = null,
        ?string $authUsername = null,
        string $description = '',
        bool $issues = true,
        bool $labels = true,
        bool $milestones = true,
        bool $mirror = true,
        bool $private = true,
        bool $pullRequests = true,
        bool $releases = true,
        bool $wiki = true
    ): array
    {
        $options = [
            'json' => [
                'clone_addr' => $cloneAddr,
                'repo_name' => $repoName,
                'uid' => $uid,
                'auth_password' => $authPassword,
                'auth_username' => $authUsername,
                'description' => $description,
                'issues' => $issues,
                'labels' => $labels,
                'milestones' => $milestones,
                'mirror' => $mirror,
                'private' => $private,
                'pull_requests' => $pullRequests,
                'releases' => $releases,
                'wiki' => $wiki,
            ]
        ];

        $options['json'] = $this->removeNullValues($options['json']);
        $response = $this->client->request(self::BASE_URI . '/migrate', 'POST', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $query
     * @param bool|null $topic
     * @param bool|null $includeDesc
     * @param int|null $uid
     * @param int|null $priorityOwnerId
     * @param int|null $starredBy
     * @param bool|null $private
     * @param bool|null $template
     * @param int|null $page
     * @param int|null $limit
     * @param string|null $mode
     * @param bool|null $exclusive
     * @param string|null $sort
     * @param string|null $order
     * @return array
     */
    public function search(
        string $query,
        ?bool $topic = null,
        ?bool $includeDesc = null,
        ?int $uid = null,
        ?int $priorityOwnerId = null,
        ?int $starredBy = null,
        ?bool $private = null,
        ?bool $template = null,
        ?int $page = null,
        ?int $limit = null,
        ?string $mode = null,
        ?bool $exclusive = null,
        ?string $sort = null,
        ?string $order = null
    ): array
    {
        $options['query'] = [
            'query' => $query,
            'topic' => $topic,
            'includeDesc' => $includeDesc,
            'uid' => $uid,
            'priorityOwnerId' => $priorityOwnerId,
            'starredBy' => $starredBy,
            'private' => $private,
            'template' => $template,
            'page' => $page,
            'limit' => $limit,
            'mode' => $mode,
            'exclusive' => $exclusive,
            'sort' => $sort,
            'order' => $order,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/search', 'GET', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return array
     */
    public function get(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @return bool
     */
    public function delete(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName, 'DELETE');
        return true;
    }

    /**
     * @param string $owner
     * @param string $repositoryName
     * @param bool|null $allow_merge_commits
     * @param bool|null $allow_rebase
     * @param bool|null $allow_rebase_explicit
     * @param bool|null $allow_squash_merge
     * @param bool|null $archived
     * @param string|null $default_branch
     * @param string|null $description
     * @param string|null $external_tracker_format
     * @param string|null $external_tracker_style
     * @param string|null $external_tracker_url
     * @param string|null $external_wiki_url
     * @param bool|null $has_issues
     * @param bool|null $has_pull_requests
     * @param bool|null $has_wiki
     * @param bool|null $ignore_whitespace_conflicts
     * @param bool|null $allow_only_contributors_to_track_time
     * @param bool|null $enable_issue_dependencies
     * @param bool|null $enable_time_tracker
     * @param string|null $name
     * @param bool|null $private
     * @param bool|null $template
     * @param string|null $website
     * @return array
     */
    public function update(
        string $owner,
        string $repositoryName,
        bool $allow_merge_commits = null,
        bool $allow_rebase = null,
        bool $allow_rebase_explicit = null,
        bool $allow_squash_merge = null,
        bool $archived = null,
        string $default_branch = null,
        string $description = null,
        string $external_tracker_format = null,
        string $external_tracker_style = null,
        string $external_tracker_url = null,
        string $external_wiki_url = null,
        bool $has_issues = null,
        bool $has_pull_requests = null,
        bool $has_wiki = null,
        bool $ignore_whitespace_conflicts = null,
        bool $allow_only_contributors_to_track_time = null,
        bool $enable_issue_dependencies = null,
        bool $enable_time_tracker = null,
        string $name = null,
        bool $private = null,
        bool $template = null,
        string $website = null
    ): array
    {
        $options['json'] = [
            'allow_merge_commits' => $allow_merge_commits,
            'allow_rebase' => $allow_rebase,
            'allow_rebase_explicit' => $allow_rebase_explicit,
            'allow_squash_merge' => $allow_squash_merge,
            'archived' => $archived,
            'default_branch' => $default_branch,
            'description' => $description,
            'external_tracker' => [
                'external_tracker_format' => $external_tracker_format,
                'external_tracker_style' => $external_tracker_style,
                'external_tracker_url' => $external_tracker_url,
            ],
            'external_wiki' => [
                'external_wiki_url' => $external_wiki_url,
            ],
            'has_issues' => $has_issues,
            'has_pull_requests' => $has_pull_requests,
            'has_wiki' => $has_wiki,
            'ignore_whitespace_conflicts' => $ignore_whitespace_conflicts,
            'internal_tracker' => [
                'allow_only_contributors_to_track_time' => $allow_only_contributors_to_track_time,
                'enable_issue_dependencies' => $enable_issue_dependencies,
                'enable_time_tracker' => $enable_time_tracker,
            ],
            'name' => $name,
            'private' => $private,
            'template' => $template,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName, 'PATCH', $options);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
