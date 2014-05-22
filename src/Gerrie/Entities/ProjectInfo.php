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
// @link https://gerrit-review.googlesource.com/Documentation/rest-api-projects.html#project-info
class ProjectInfo
{
    /**
     * The URL encoded project name.
     *
     * @var string
     */
    protected $id;

    /**
     * The name of the project.
     *
     * @var string
     */
    protected $name;

    /**
     * The name of the parent project.
     *
     * @var string
     */
    protected $parent;

    /**
     * The description of the project.
     *
     * @var string
     */
    protected $description;

    /**
     * ACTIVE, READ_ONLY or HIDDEN.
     *
     * @var string
     */
    protected $state;

    /**
     * Map of branch names to HEAD revisions.
     *
     * @TODO what is this for a type?!
     * @var array
     */
    protected $branches;

    /**
     * Links to the project in external sites as a list of WebLinkInfo entries.
     *
     * TODO is the type correct?
     * @var WebLinkInfo[]
     */
    protected $webLinks;

    /**
     * @param array $branches
     */
    public function setBranches($branches)
    {
        $this->branches = $branches;
    }

    /**
     * @return array
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param \Gerrie\Entities\WebLinkInfo[] $webLinks
     */
    public function setWebLinks($webLinks)
    {
        $this->webLinks = $webLinks;
    }

    /**
     * @return \Gerrie\Entities\WebLinkInfo[]
     */
    public function getWebLinks()
    {
        return $this->webLinks;
    }
}