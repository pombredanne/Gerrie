<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CommitInfo
{
    /**
     * The commit ID.
     *
     * @var string
     */
    public $commit;

    /**
     * The parent commits of this commit as a list of CommitInfo entities.
     * In each parent only the commit and subject fields are populated.
     *
     * @var array
     */
    public $parents;

    /**
     * The author of the commit as a GitPersonInfo entity.
     *
     * @var GitPersonInfo
     */
    public $author;

    /**
     * The committer of the commit as a GitPersonInfo entity.
     *
     * @var GitPersonInfo
     */
    public $committer;

    /**
     * The subject of the commit (header line of the commit message).
     *
     * @var string
     */
    public $subject;

    /**
     * The commit message.
     *
     * @var string
     */
    public $message;
}