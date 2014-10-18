<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ChangeMessageInfo
{
    /**
     * The ID of the message.
     *
     * @var string
     */
    public $id;

    /**
     * Author of the message as an AccountInfo entity.
     * Unset if written by the Gerrit system.
     *
     * Optional
     *
     * @var AccountInfo
     */
    public $author;

    /**
     * The timestamp this message was posted.
     *
     * Timestamps are given in UTC and have the format "yyyy-mm-dd hh:mm:ss.fffffffff" where "ffffffffff" indicates the nanoseconds.
     *
     * @var string
     */
    public $date;

    /**
     * The text left by the user.
     *
     * @var string
     */
    public $message;

    /**
     * Which patchset (if any) generated this message.
     *
     * Optional
     *
     * @var string
     */
    public $_revision_number;
}