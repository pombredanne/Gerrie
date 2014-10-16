<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\Entity;

class Server implements EntityInterface
{

    /**
     * The name of the Gerrit instance.
     *
     * @var string
     */
    public $name;

    /**
     * The host of the Gerrit instance.
     *
     * @var string
     */
    public $host;
}