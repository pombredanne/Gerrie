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

class TransformerComposite implements TransformerInterface
{
    /**
     * Collection of transformers
     *
     * @var array[TransformerInterface]
     */
    private $transformers = [];

    /**
     * Adds a transformer to the local transformer collection
     *
     * @param TransformerInterface $transformer
     * @return void
     */
    public function addTransformer(TransformerInterface $transformer)
    {
        $this->transformers[] = $transformer;
    }

    /**
     * Transform the given data into an Entity
     *
     * @param array $data
     * @return \Gerrie\Entity\EntityInterface
     */
    public function transform(array $data)
    {
        foreach ($this->transformers as $transformer) {
            /** @var TransformerInterface $transformer */
            if ($transformer->isResponsible($data) === true) {
                return $transformer->transform($data);
            }
        }
    }

    /**
     * Checks if the current data transformer is responsible to transform the given data.
     *
     * @param array $data
     * @return boolean
     */
    public function isResponsible(array $data)
    {
        return true;
    }
}