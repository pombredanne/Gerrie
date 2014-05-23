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

use Gerrie\Process\ProcessFactory;
use Symfony\Component\Process\ProcessUtils;

// TODO class header
class SSH implements RemoteConnectorInterface
{

    /**
     * Process factory
     *
     * @var \Gerrie\Process\ProcessFactory
     */
    protected $processFactory;

    /**
     * SSH executable
     *
     * @var string
     */
    protected $executable;

    /**
     * Command to execute
     *
     * @var string
     */
    protected $command;

    /**
     * Constructor
     *
     * @param string $executable
     * @param ProcessFactory $processFactory
     */
    public function __construct($executable, ProcessFactory $processFactory)
    {
        $this->processFactory = $processFactory;
        $this->setExecutable($executable);
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

    /**
     * Escapes a argument for SSH
     *
     * @param string $argument
     * @return string
     */
    public function escapeArgument($argument)
    {
        return ProcessUtils::escapeArgument($argument);
    }

    /**
     * Executes the built command.
     * Returns the output of the command.
     *
     * @return array|string
     */
    public function execute()
    {
        $command = $this->getExecutable() . ' ' . $this->getCommand();

        $process = $this->processFactory->createProcess($command);
        $process->run();
        $data = $process->getOutput();

        return $data;
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
     * Sets the path of the SSH executable
     *
     * @param string $executable Path to the executable
     * @return void
     * @throws \Exception
     */
    private function setExecutable($executable)
    {
        if (is_executable($executable) === false) {
            throw new \Exception('SSH executable is not executable!', 1364032483);
        }

        $this->executable = $executable;
    }

    /**
     * Gets the path of the SSH executable
     *
     * @return string
     */
    private function getExecutable()
    {
        return $this->executable;
    }
}