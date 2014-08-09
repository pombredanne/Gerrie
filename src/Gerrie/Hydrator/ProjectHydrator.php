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

        $name = ((isset($data['name'])) ? $data['name']: $data['id']);
        $object->setName($name);

        $parent = ((isset($data['parent'])) ? $data['parent']: '');
        $object->setParent($parent);

        $description = ((isset($data['description'])) ? $data['description']: '');
        $object->setDescription($description);

        $state = ((isset($data['state'])) ? $data['state']: '');
        $object->setState($state);

        // TODO branches (HTTP)
        // TODO web_links (HTTP)
        // TODO kind (SSH)

        return $object;
    }
}