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

interface RemoteDataServiceInterface
{
    public function getRemoteConnector();

    public function setRemoteConnector(RemoteConnectorInterface $remoteConnector);

    /**
     * Returns all projects of a Gerrit server
     *
     * @return array|null
     */
    public function getProjects();

    /**
     * Returns changesets from the Gerrit server.
     *
     * @param string $projectName The project name
     * @param string $resumeKey The key where the request will be resumed
     * @return array
     */
    public function getChangesets($projectName, $resumeKey = null);
}