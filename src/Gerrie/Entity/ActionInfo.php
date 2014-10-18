<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ActionInfo
{

    /**
     * HTTP method to use with the action.
     * Most actions use POST, PUT or DELETE to cause state changes.
     *
     * Optional
     *
     * @var string
     */
    public $method;

    /**
     * Short title to display to a user describing the action.
     * In the Gerrit web interface the label is used as the text on the button presented in the UI.
     *
     * Optional
     *
     * @var string
     */
    public $label;

    /**
     * Longer text to display describing the action.
     * In a web UI this should be the title attribute of the element, displaying when the user hovers the mouse.
     *
     * Optional
     *
     * @var string
     */
    public $title;

    /**
     * If true the action is permitted at this time and the caller is likely allowed to execute it.
     * This may change if state is updated at the server or permissions are modified.
     * Not present if false.
     *
     * Optional
     *
     * @var boolean
     */
    public $enabled;
}