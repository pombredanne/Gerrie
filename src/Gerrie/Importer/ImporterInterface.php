<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\Importer;

use \Gerrie\Entity\EntityInterface;

interface ImporterInterface
{

    /**
     * Import logic to import the given data.
     *
     * @param EntityInterface $data
     * @return void
     */
    public function import(EntityInterface $data);

    /**
     * Checks if the current importer is responsible for the given data.
     *
     * @param EntityInterface $data
     * @return boolean
     */
    public function isResponsible(EntityInterface $data);
}