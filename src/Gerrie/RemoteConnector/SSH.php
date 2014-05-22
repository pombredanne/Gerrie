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

class SSH implements RemoteConnectorInterface
{

    protected $processFactory;

    protected $commandParts = array();

    protected $arguments = array();

    protected $executable = '';

    public function __construct($executable, ProcessFactory $processFactory)
    {
        $this->processFactory = $processFactory;
        $this->setExecutable($executable);
    }

    public function escapeArgument($argument)
    {
        return ProcessUtils::escapeArgument($argument);
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
        $data = array();
        $command = $this->getCommand();

        $data = $this->execCommand($command, $data);

        if ($implodeReturnValue === false) {
            return $data;
        }

        return implode('', $data);
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
        $this->commandParts = array();
        $this->arguments = array();
    }

    /**
     * Prepares and builds the full command.
     * All properties, like ssh key, port, command and agruments will be considered
     *
     * @return string
     */
    protected function prepareCommand()
    {
        $command = $this->getExecutable() . ' ';

        $command .= implode(' ', $this->getCommandParts()) . ' ';
        $command .= implode(' ', $this->getArguments());
        $command .= ' 2>&1';

        return $command;
    }



    /**
     * Wrapped exec()-call.
     * This makes unit testing possible.
     *
     * @param string $command The command to execute
     * @param array $data Array where the result will be stored
     * @return array
     */
    private function execCommand($command, array $data)
    {
var_dump($command);die();
        exec($command, $data);

        return $data;
    }

    /**
     * Returns the full command, which will be executed.
     *
     * @return string
     */
    private function getCommand()
    {
        return $this->prepareCommand();
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

    /**
     * Gets all command parts
     *
     * @see $this->addCommandPart()
     *
     * @return array
     */
    private function getCommandParts()
    {
        return $this->commandParts;
    }

    /**
     * Adds a command part to the command.
     *
     * e.g.
     *        Command: ./console gerrie:export
     *                 => "gerrie:export" is a command part
     *
     *        Command: git merge
     *                 => "merge" is a command part
     *
     * @param string $commandPart The command part
     * @return void
     */
    private function addCommandPart($commandPart)
    {
        $this->commandParts[] = ($commandPart);
    }

    /**
     * Gets all command arguments
     *
     * @see $this->addArgument()
     *
     * @return array
     */
    private function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Adds a new argument to the SSH command.
     *
     * e.g.
     *        --help       => $argument = '--help', $value = '', $glue = ''
     *        --foo=bar    => $argument = '--foo', $value = 'bar', $glue = '='
     *        --foo bar    => $argument = '--foo', $value = 'bar', $glue = ''
     *
     * @param string $argument Name of argument
     * @param string $value Value of argument
     * @param string $glue Concat value of $argument and $value
     * @return void
     */
    private function addArgument($argument, $value, $glue)
    {
        $escapedValue = (($value) ? escapeshellarg($value) : '');
        $this->arguments[] = $argument . $glue . $escapedValue;
    }
}