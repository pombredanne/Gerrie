<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class GitPersonInfo
{
    /**
     * The name of the author/committer.
     *
     * @var string
     */
    public $name;

    /**
     * The email address of the author/committer.
     *
     * @var string
     */
    public $email;

    /**
     * The timestamp of when this identity was constructed.
     *
     * Timestamps are given in UTC and have the format "yyyy-mm-dd hh:mm:ss.fffffffff" where "ffffffffff" indicates the nanoseconds.
     *
     * @var string
     */
    public $date;

    /**
     * The timezone offset from UTC of when this identity was constructed.
     *
     * @var integer
     */
    public $tz;
}