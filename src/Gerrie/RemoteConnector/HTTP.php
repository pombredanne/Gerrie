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

// TODO class header comment
class HTTP implements RemoteConnectorInterface
{

    /**
     * HTTP "browser"
     *
     * @var \Buzz\Browser
     */
    private $browser;

    /**
     * Command to execute
     *
     * @var string
     */
    private $command;

    /**
     * Constructor
     *
     * @param \Buzz\Browser $remoteConnector
     */
    public function __construct(\Buzz\Browser $remoteConnector)
    {
        $this->browser = $remoteConnector;
    }

    /**
     * Escapes a argument for HTTP
     *
     * @param string $argument
     * @return string
     */
    public function escapeArgument($argument)
    {
        return rawurlencode($argument);
    }

    /**
     * Executes the built command.
     * Returns the output of the command.
     *
     * @return string
     */
    public function execute()
    {
        $command = $this->getCommand();
        $response = $this->browser->get($command);

        $response = $this->verifyResult($response, $command);

        return $response->getContent();
    }

    /**
     * Verifies the last request.
     * If the last request was not successful, it will be throw an exception.
     *
     * @param \Buzz\Message\Response $response The response object from the last reques
     * @param string $url The url which was requested
     * @return \Buzz\Message\Response
     * @throws \Exception
     */
    private function verifyResult(\Buzz\Message\Response $response, $url)
    {
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Request to "' . $url . '" failed', 1364061673);
        }

        return $response;
    }

    /**
     * Resets all command specific parts.
     * This can be used to fire many ssh commands with one ssh object.
     *
     * @return void
     */
    public function reset()
    {
        $this->setCommand('');
    }

    /**
     * Returns the command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Sets the command
     *
     * @param string $command
     * @return void
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }
}