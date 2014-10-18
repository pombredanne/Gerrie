<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ApprovalInfo extends AccountInfo
{

    /**
     * The vote that the user has given for the label.
     * If present and zero, the user is permitted to vote on the label.
     * If absent, the user is not permitted to vote on that label.
     *
     * Optional
     *
     * @var string
     */
    public $value;

    /**
     * The time and date describing when the approval was made.
     *
     * Optional
     *
     * @var string
     */
    public $date;
}