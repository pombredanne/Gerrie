<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class AccountInfo
{

    /**
     * The numeric ID of the account.
     *
     * @var integer
     */
    public $_account_id;

    /**
     * The full name of the user.
     * Only set if detailed account information is requested.
     *
     * Optional
     *
     * @var string
     */
    public $name;

    /**
     * The email address the user prefers to be contacted through.
     * Only set if detailed account information is requested.
     *
     * Optional
     *
     * @var string
     */
    public $email;

    /**
     * The username of the user.
     * Only set if detailed account information is requested.
     *
     * Optional
     *
     * @var string
     */
    public $username;
}