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

abstract class AbstractRemoteDataService implements RemoteDataServiceInterface
{
    /**
     * API connector like HTTP or SSH
     *
     * @var RemoteConnectorInterface
     */
    private $remoteConnector = null;

    /**
     * Sets the API connector
     *
     * @param RemoteConnectorInterface $remoteConnector API connector like HTTP Client
     * @return void
     */
    public function setRemoteConnector(RemoteConnectorInterface $remoteConnector)
    {
        $this->remoteConnector = $remoteConnector;
    }

    /**
     * Returns the API connector
     *
     * @return RemoteConnectorInterface
     */
    public function getRemoteConnector()
    {
        return $this->remoteConnector;
    }

    /**
     * Requests projects at the Gerrit server
     *
     * @return array|null
     */
    abstract public function getProjects();
}