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
// TODO method comments
interface RemoteConnectorInterface
{
    public function escapeArgument($argument);

    public function execute();

    public function reset();

    public function getCommand();

    public function setCommand($command);
}