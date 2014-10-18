<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class FetchInfo
{
    /**
     * The URL of the project.
     *
     * @var string
     */
    public $url;

    /**
     * The ref of the patch set.
     *
     * @var string
     */
    public $ref;

    /**
     * The download commands for this patch set as a map that maps the command names to the commands.
     * Only set if download commands are requested.
     *
     * Optional
     *
     * @var array
     */
    public $commands;
}