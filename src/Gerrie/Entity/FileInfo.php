<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class FileInfo
{
    /**
     * The status of the file ("A"=Added, "D"=Deleted, "R"=Renamed, "C"=Copied, "W"=Rewritten).
     * Not set if the file was Modified ("M").
     *
     * Optional
     *
     * @var string
     */
    public $status;

    /**
     * Whether the file is binary.
     *
     * Not set if false
     *
     * @var boolean
     */
    public $binary;

    /**
     * The old file path.
     * Only set if the file was renamed or copied.
     *
     * Optional
     *
     * @var string
     */
    public $old_path;

    /**
     * Number of inserted lines.
     * Not set for binary files or if no lines were inserted.
     *
     * Optional
     *
     * @var integer
     */
    public $lines_inserted;

    /**
     * Number of deleted lines.
     * Not set for binary files or if no lines were deleted.
     *
     * Optional
     *
     * @var integer
     */
    public $lines_deleted;
}