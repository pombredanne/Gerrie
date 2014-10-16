<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\Transformer;

interface TransformerInterface
{

    /**
     * Transform the given data into an Entity
     *
     * @param array $data
     * @return \Gerrie\Entity\EntityInterface
     */
    public function transform(array $data);

    /**
     * Checks if the current data transformer is responsible to transform the given data.
     *
     * @param array $data
     * @return boolean
     */
    public function isResponsible(array $data);
}