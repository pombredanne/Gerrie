<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\RemoteDataService;

use \Buzz\Listener\BasicAuthListener;
use Gerrie\RemoteConnector\RemoteConnectorInterface;

class HTTP extends AbstractRemoteDataService
{

    /**
     * HTTP Host
     *
     * @var string
     */
    private $host;

    /**
     * Username to access $host
     *
     * @var string
     */
    private $username;

    /**
     * Password to access $host
     *
     * @var string
     */
    private $password;

    /**
     * Constructor
     *
     * @param \Gerrie\RemoteConnector\RemoteConnectorInterface $remoteConnector
     * @param string $host
     * @param string $username
     * @param string $password
     * @return \Gerrie\RemoteDataService\HTTP
     */
    public function __construct(RemoteConnectorInterface $remoteConnector, $host, $username = '', $password = '')
    {
        $this->setRemoteConnector($remoteConnector);

        $this->setHost($host);
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Sets the HTTP host
     *
     * @param string $host
     * @return void
     */
    private function setHost($host)
    {
        $host = rtrim($host, '/') . '/';
        $this->host = $host;
    }

    /**
     * Return the HTTP host
     *
     * @return string
     */
    private function getHost()
    {
        return $this->host;
    }

    /**
     * Gets the base url for all HTTP requests.
     *
     * @param bool $withAuthentication If true, the authentification string will be appended. False otherwise
     * @return string
     */
    private function getBaseUrl($withAuthentication = false)
    {
        $baseUrl = $this->getHost();

        if ($withAuthentication === true && $this->getRemoteConnector()->getListener() instanceof BasicAuthListener) {
            $baseUrl .= 'a/';
        }

        return $baseUrl;
    }

    /**
     * Transforms a JSON string into an array.
     * Regular, the json is the content from the response.
     *
     * @param string $json The json string
     * @return array|null
     */
    private function transformJsonResponse($json)
    {
        // In a REST-API call, the first five chars are )]}'\n
        // to decode it, we have to strip it
        // See https://review.typo3.org/Documentation/rest-api.html#output
        if (substr($json, 0, 4) === ')]}\'') {
            $json = substr($json, 5);
        }

        return json_decode($json, true);
    }

    /**
     * Initiales the query limit
     *
     * @return int
     */
    private function initQueryLimit()
    {
        throw new \Exception('NOT IMPLEMENT ... ' . __METHOD__);
        $url = $this->getBaseUrl(true) . 'accounts/self/capabilities?format=JSON';
        $response = $this->getRemoteConnector()->get($url);
        $response = $this->verifyResult($response, $url);

        $content = $this->transformJsonResponse($response->getContent());

        return $content['queryLimit']['max'];
    }

    /**
     * Requests projects from the Gerrit server
     *
     * @return array|null
     */
    public function getProjects()
    {
        $urlParts = array(
            'format' => 'JSON',
            'description' => '',
            'type' => 'all',
            'all' => '',
            'tree' => '',
        );

        $url = $this->getBaseUrl() . 'projects/?' . http_build_query($urlParts);

        $remoteConnector = $this->getRemoteConnector();
        $remoteConnector->reset();
        $remoteConnector->setCommand($url);
        $response = $remoteConnector->execute();

        $content = $this->transformJsonResponse($response);

        return $content;
    }

    /**
     * Requests changesets at the Gerrit server.
     *
     * This method is not implemented yet, because at the moment (2013-03-24) Gerrit 2.6.* is not released.
     * Many Gerrit systems (e.g. TYPO3, WikiMedia, OpenStack, etc.) are running at 2.5.*.
     * In 2.5.* the SSH API delivers more information than the REST API.
     *
     * If Gerrit 2.6 is released, the HTTP DataService will be extended and fully implemented.
     * Maybe, you want to help me?
     *
     * SSH commands:
     * /usr/bin/ssh -p 29418 review.typo3.org gerrit query --format 'JSON' --current-patch-set
     *                                                     --all-approvals --files --comments
     *                                                     --commit-message --dependencies --submit-records
     *                                                     'project:Documentation/ApiTypo3Org' limit:'500' 2>&1
     * /usr/bin/ssh -p 29418 review.typo3.org gerrit query --format 'JSON' --current-patch-set
     *                                                     --all-approvals --files --comments
     *                                                     --commit-message --dependencies --submit-records
     *                                                     'project:Documentation/ApiTypo3Org' limit:'500'
     *                                                     resume_sortkey:'00215ec7000041b3' 2>&1
     *
     * @param string $projectName The project name
     * @param string $resumeKey The key where the request will be resumed
     * @return array|null
     * @throws \Exception
     */
    public function getChangesets($projectName, $resumeKey = null)
    {
        throw new \Exception(__METHOD__ . ' not implemented yet. Will you help me?', 1374257295);
        $urlParts = array(
            'q' => sprintf('project:%s', $projectName),
            'n' => $this->getQueryLimit()
        );

        // The "o" parameter can be applied more than one time
        // This parameter defines how detailed the answer will be
        $oOptions = array(
            'LABELS',
            'DETAILED_LABELS',
            'CURRENT_REVISION',
            'ALL_REVISIONS',
            'CURRENT_COMMIT',
            'ALL_COMMITS',
            'CURRENT_FILES',
            'ALL_FILES',
            'DETAILED_ACCOUNTS',
            'MESSAGES'
        );
        $additionalFields = $this->buildQueryStringWithSameParameterName('o', $oOptions);
        $url = $this->getBaseUrl() . 'changes/?' . http_build_query($urlParts) . '&' . $additionalFields;

        $response = $this->getConnector()->get($url);
        $response = $this->verifyResult($response, $url);

        $content = $this->transformJsonResponse($response->getContent());

        return $content;
    }

    /**
     * This function build a url query string with a parameter which can be applied more than one time.
     * E.g. http://www.google.de/?q=5&q=6&q=7&q=8&q=9...
     *
     * This method is used to apply the parameter "o" in GET /changes/ command for REST-API.
     *
     * @see https://review.typo3.org/Documentation/rest-api-changes.html#list-changes
     *
     * @param string $parameterName Parametername which should be used more than one time
     * @param array $values Various of values
     * @return string
     */
    private function buildQueryStringWithSameParameterName($parameterName, array $values)
    {
        throw new \Exception('NOT IMPLEMENT ... ' . __METHOD__);
        $queryString = '';

        foreach ($values as $value) {
            if ($queryString) {
                $queryString .= '&';
            }

            $queryString .= http_build_query(array($parameterName => $value));
        }

        return $queryString;
    }
}