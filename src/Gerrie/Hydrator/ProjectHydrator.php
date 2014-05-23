<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\Hydrator;

// TODO class comment
class ProjectHydrator implements HydratorInterface
{

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return void
     */
    public function hydrate(array $data, $object)
    {
        /** @var \Gerrie\Entities\ProjectInfo $object */
        $object->setId($data['id']);
        $object->setParent($data['parent']);
        $object->setDescription($data['description']);
        $object->setState($data['state']);

        // TODO branches
        // TODO web_links

        return $object;
    }
}