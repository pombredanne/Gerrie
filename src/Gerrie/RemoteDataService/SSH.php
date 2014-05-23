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

use Gerrie\RemoteConnector\RemoteConnectorInterface;

// TODO class header comment
class SSH extends AbstractRemoteDataService
{

    /**
     * SSH Host
     *
     * @var string
     */
    private $host;

    /**
     * SSH Port
     *
     * @var integer
     */
    private $port;

    /**
     * Username to access $host
     *
     * @var string
     */
    private $username;

    /**
     * SSH keyfile to access $host
     *
     * @var string
     */
    private $keyFile;

    /**
     * Constructor
     *
     * @param \Gerrie\RemoteConnector\RemoteConnectorInterface $remoteConnector
     * @param string $host
     * @param integer $port
     * @param string $username
     * @param string $keyFile
     * @return \Gerrie\RemoteDataService\SSH
     */
    public function __construct(RemoteConnectorInterface $remoteConnector, $host, $port, $username, $keyFile = '')
    {
        $this->setRemoteConnector($remoteConnector);

        $this->host = $host;
        $this->port = (int) $port;
        $this->username = $username;
        $this->keyFile = $keyFile;
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
        return json_decode($json, true);
    }

    /**
     * Requests projects from the Gerrit server
     *
     * The ls-projects command supports a "limit" argument
     * The default limit from Gerrit is 500.
     * What happen when the Gerrit system got more then 500 projects?
     * I don`t see a "resume_sortkey" option here :(
     * Does anyone know this?
     *
     * @return array|null
     */
    public function getProjects()
    {
        $remoteConnector = $this->getRemoteConnector();

        $commandParts = $this->getBaseCommandParts();
        $commandParts[] = 'ls-projects';
        $commandParts[] = '--format ' . $remoteConnector->escapeArgument('JSON');
        $commandParts[] = '--description';
        $commandParts[] = '--tree';
        $commandParts[] = '--type ' . $remoteConnector->escapeArgument('all');
        $commandParts[] = '--all';

        $command = implode(' ', $commandParts);

        $remoteConnector->reset();
        $remoteConnector->setCommand($command);

        $content = $remoteConnector->execute();
        $content = $this->transformJsonResponse($content);

        return $content;
    }

    /**
     * Gets the base ssh query array for all SSH requests.
     *
     * @return array
     */
    private function getBaseCommandParts()
    {
        // TODO should i escape this via remoteConnector?
        $host = $this->host;
        if (isset($this->username) === true) {
            $host = $this->username . '@' . $host;
        }

        $commandParts = [
            $this->getKeyfilePart(),
            $this->getPortPart(),
            $host,
            'gerrit'
        ];

        return $commandParts;
    }

    /**
     * Return the command part for ssh port specification
     *
     * @return string
     */
    private function getPortPart()
    {
        $command = '';

        if ($this->port > 0) {
            $command = '-p ' . $this->port;
        }

        return $command;
    }

    /**
     * Return the command part for ssh key file specification
     *
     * @return string
     */
    private function getKeyfilePart()
    {
        $command = '';

        // @todo add file_exists($keyFile) === true
        // At the moment this is not working, because i don`t know a PHP function to resolve ~/.ssh/private_key_file
        // https://twitter.com/andygrunwald/status/315413070904184832
        // Further more, $keyFile can`t be escaped with escapeshellarg(),
        // because after this the command is not working anymore
        if ($this->keyFile) {
            $command = '-i ' . $this->keyFile;
        }

        return $command;
    }

    /**
     * Requests changesets at the Gerrit server.
     *
     * @param string $projectName The project name
     * @param string $resumeKey The key where the request will be resumed
     * @return array
     * @throws \Exception
     */
    public function getChangesets($projectName, $resumeKey = null)
    {
        throw new \Exception('NOT IMPLEMENTED ... ' . __METHOD__);
        $connector = $this->getBaseQuery();

        $connector->addCommandPart('query');
        $connector->addArgument('--format', 'JSON', ' ');
        $connector->addArgument('--current-patch-set', '', ' ');
        $connector->addArgument('--all-approvals', '', '');
        $connector->addArgument('--files', '', '');
        $connector->addArgument('--comments', '', '');
        $connector->addArgument('--commit-message', '', '');
        $connector->addArgument('--dependencies', '', '');
        $connector->addArgument('--submit-records', '', '');
        $connector->addArgument('', 'project:' . $projectName, '');
        $connector->addArgument('limit', 500, ':');

        if ($resumeKey) {
            $connector->addArgument('resume_sortkey', $resumeKey, ':');
        }

        $content = $connector->execute(false);
        return $content;
    }
}