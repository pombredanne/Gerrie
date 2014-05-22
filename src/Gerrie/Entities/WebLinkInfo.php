<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\Entities;

// TODO add class header
// @link https://gerrit-review.googlesource.com/Documentation/rest-api-changes.html#web-link-info
class WebLinkInfo
{

    /**
     * The link name.
     *
     * @var string
     */
    protected $name;

    /**
     * The link URL.
     *
     * @var string
     */
    protected $url;
}