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

class ImporterComposite implements ImporterInterface
{
    /**
     * Collection of importers
     *
     * @var array[ImporterInterface]
     */
    private $importer = [];

    /**
     * Adds a importer to the local import collection
     *
     * @param ImporterInterface $importer
     * @return void
     */
    public function addImporter(ImporterInterface $importer)
    {
        $this->importer[] = $importer;
    }

    /**
     * Import logic to import the given data.
     *
     * @param EntityInterface $data
     * @return void
     */
    public function import(EntityInterface $data)
    {
        foreach ($this->importer as $importer) {
            /** @var ImporterInterface $importer */
            if ($importer->isResponsible($data) === true) {
                $importer->import($data);
            }
        }
    }

    /**
     * Checks if the current importer is responsible for the given data.
     *
     * @param EntityInterface $data
     * @return boolean
     */
    public function isResponsible(EntityInterface $data)
    {
        return true;
    }
}