<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ChangeInfo
{

    /**
     * gerritcodereview#change
     *
     * @var string
     */
    public $kind;

    /**
     * The ID of the change in the format "<project>~<branch>~<Change-Id>",
     * where project, branch and Change-Id are URL encoded.
     * For branch the refs/heads/ prefix is omitted.
     *
     * @var string
     */
    public $id;


    /**
     * The name of the project.
     *
     * @var string
     */
    public $project;

    /**
     * The name of the target branch.
     * The refs/heads/ prefix is omitted.
     *
     * @var string
     */
    public $branch;

    /**
     * The topic to which this change belongs.
     *
     * Optional
     *
     * @var string
     */
    public $topic;

    /**
     * The Change-Id of the change.
     *
     * @var string
     */
    public $change_id;

    /**
     * The subject of the change (header line of the commit message).
     *
     * @var string
     */
    public $subject;

    /**
     * The status of the change (NEW, SUBMITTED, MERGED, ABANDONED, DRAFT).
     *
     * @var string
     */
    public $status;

    /**
     * The timestamp of when the change was created.
     *
     * Timestamps are given in UTC and have the format "yyyy-mm-dd hh:mm:ss.fffffffff"
     * where "ffffffffff" indicates the nanoseconds.
     *
     * @var string
     */
    public $created;

    /**
     * The timestamp of when the change was last updated.
     *
     * Timestamps are given in UTC and have the format "yyyy-mm-dd hh:mm:ss.fffffffff"
     * where "ffffffffff" indicates the nanoseconds.
     *
     * @var string
     */
    public $updated;

    /**
     * Whether the calling user has starred this change.
     *
     * Not set if false
     *
     * @var string
     */
    public $starred;

    /**
     * Whether the change was reviewed by the calling user.
     * Only set if reviewed is requested.
     *
     * Not set if false
     *
     * @var string
     */
    public $reviewed;

    /**
     * Whether the change is mergeable.
     * Not set for merged changes.
     *
     * Optional
     *
     * @var string
     */
    public $mergeable;

    /**
     * Number of inserted lines.
     *
     * @var integer
     */
    public $insertions;

    /**
     * Number of deleted lines.
     *
     * @var integer
     */
    public $deletions;

    /**
     * The sortkey of the change.
     *
     * @var string
     */
    public $_sortkey;

    /**
     * The legacy numeric ID of the change.
     *
     * @var integer
     */
    public $_number;

    /**
     * The owner of the change as an AccountInfo entity.
     *
     * @var AccountInfo
     */
    public $owner;

    /**
     * Actions the caller might be able to perform on this revision.
     * The information is a map of view name to ActionInfo entities.
     *
     * Optional
     *
     * @var array
     */
    public $actions;

    /**
     * The labels of the change as a map that maps the label names to LabelInfo entries.
     * Only set if labels or detailed labels are requested.
     *
     * Optional
     *
     * @var array
     */
    public $labels;

    /**
     * A map of the permitted labels that maps a label name to the list of values that are allowed for that label.
     * Only set if detailed labels are requested.
     *
     * Optional
     *
     * @var array
     */
    public $permitted_labels;

    /**
     * The reviewers that can be removed by the calling user as a list of AccountInfo entities.
     * Only set if detailed labels are requested.
     *
     * Optional
     *
     * @var array
     */
    public $removable_reviewers;

    /**
     * Messages associated with the change as a list of ChangeMessageInfo entities.
     * Only set if messages are requested.
     *
     * Optional
     *
     * @var array
     */
    public $messages;

    /**
     * The commit ID of the current patch set of this change.
     * Only set if the current revision is requested or if all revisions are requested.
     *
     * Optional
     *
     * @var string
     */
    public $current_revision;

    /**
     * All patch sets of this change as a map that maps the commit ID of the patch set to a RevisionInfo entity.
     * Only set if the current revision is requested (in which case it will only contain a key for the current revision)
     * or if all revisions are requested.
     *
     * Optional
     *
     * @var array
     */
    public $revisions;

    /**
     * Whether the query would deliver more results if not limited.
     * Only set on either the last or the first change that is returned.
     *
     * Optional, not set if false
     *
     * @var boolean
     */
    public $_more_changes;
}