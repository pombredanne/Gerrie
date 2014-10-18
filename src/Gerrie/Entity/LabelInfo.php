<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class LabelInfo
{

    /**
     * Whether the label is optional.
     * Optional means the label may be set, but it’s neither necessary for submission nor does it block submission if set.
     *
     * Not set if false
     *
     * @var boolean
     */
    public $optional;

    /**
     * One user who approved this label on the change (voted the maximum value) as an AccountInfo entity.
     *
     * Optional
     * Field set by LABELS
     *
     * @var AccountInfo
     */
    public $approved;

    /**
     * One user who rejected this label on the change (voted the minimum value) as an AccountInfo entity.
     *
     * Optional
     * Field set by LABELS
     *
     * @var AccountInfo
     */
    public $rejected;

    /**
     * One user who recommended this label on the change (voted positively,
     * but not the maximum value) as an AccountInfo entity.
     *
     * Optional
     * Field set by LABELS
     *
     * @var AccountInfo
     */
    public $recommended;

    /**
     * One user who disliked this label on the change (voted negatively,
     * but not the minimum value) as an AccountInfo entity.
     *
     * Optional
     * Field set by LABELS
     *
     * @var AccountInfo
     */
    public $disliked;

    /**
     * If true, the label blocks submit operation.
     * If not set, the default is false.
     *
     * Optional
     * Field set by LABELS
     *
     * @var boolean
     */
    public $blocking;

    /**
     * The voting value of the user who recommended/disliked this label on the change if it is not "+1"/"-1".
     *
     * Optional
     * Field set by LABELS
     *
     * @var string
     */
    public $value;

    /**
     * List of all approvals for this label as a list of ApprovalInfo entities.
     *
     * Optional
     * Field set by DETAILED_LABELS
     *
     * @var array
     */
    public $all;

    /**
     * A map of all values that are allowed for this label.
     * The map maps the values ("-2", "-1", " 0", "+1", "+2") to the value descriptions.
     *
     * Optional
     * Field set by DETAILED_LABELS
     *
     * @var array
     */
    public $values;
}