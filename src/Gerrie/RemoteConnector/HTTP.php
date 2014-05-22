<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\RemoteConnector;

class HTTP implements RemoteConnectorInterface
{

    /**
     * HTTP "browser"
     *
     * @var \Buzz\Browser
     */
    protected $browser;

    public function __construct(\Buzz\Browser $remoteConnector)
    {
        $this->browser = $remoteConnector;
    }

    public function escapeArgument($argument)
    {
        // TODO: Implement escapeArgument() method.
    }

    /**
     * Executes the built command.
     * Returns the output of the command.
     *
     * @param bool $implodeReturnValue True if the output of the executed command will be imploded. False otherwise
     * @return array|string
     */
    public function execute($implodeReturnValue = true)
    {

    }

    /**
     * Resets all command specific parts.
     * This can be used to fire many ssh commands with one ssh object.
     * Just reset() all the seetings before a new command is setted up.
     *
     * @return void
     */
    public function reset()
    {

    }
}