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

use Gerrie\Entity\Server;

class ServerTransformer implements TransformerInterface
{

    /**
     * Transform the given data into an Entity
     *
     * @param array $data
     * @return \Gerrie\Entity\EntityInterface
     */
    public function transform(array $data)
    {
        $server = new Server();
        $server->host = $data['host'];
        $server->name = $data['name'];

        return $server;
    }

    /**
     * Checks if the current data transformer is responsible to transform the given data.
     *
     * @param array $data
     * @return boolean
     */
    public function isResponsible(array $data)
    {
        return (isset($data['name']) && isset($data['host']));
    }
}