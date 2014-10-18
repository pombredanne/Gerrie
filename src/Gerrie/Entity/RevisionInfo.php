<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RevisionInfo
{

    /**
     * Whether the patch set is a draft.
     *
     * Not set if false
     *
     * @var boolean
     */
    public $draft;

    /**
     * Whether the patch set has one or more draft comments by the calling user.
     * Only set if draft comments is requested.
     *
     * Not set if false
     *
     * @var boolean
     */
    public $has_draft_comments;

    /**
     * The patch set number.
     *
     * @var integer
     */
    public $_number;

    /**
     * Information about how to fetch this patch set.
     * The fetch information is provided as a map that maps the protocol name ("git", "http", "ssh") to FetchInfo entities.
     *
     * @var
     */
    public $fetch;

    /**
     * The commit of the patch set as CommitInfo entity.
     *
     * Optional
     *
     * @var
     */
    public $commit;

    /**
     * The files of the patch set as a map that maps the file names to FileInfo entities.
     *
     * Optional
     *
     * @var
     */
    public $files;

    /**
     * Actions the caller might be able to perform on this revision.
     * The information is a map of view name to ActionInfo entities.
     *
     * Optional
     *
     * @var array
     */
    public $actions;
}