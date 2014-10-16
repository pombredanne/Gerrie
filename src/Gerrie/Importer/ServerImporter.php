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
use \Gerrie\Helper\Database;

class ServerImporter extends BaseImporter
{
    /**
     * Import logic to import the given data.
     *
     * Checks if the given Gerrit server is known by the database.
     * If we don`t know this host, we save this to the database.
     *
     * @param EntityInterface $data
     * @return void
     */
    public function import(EntityInterface $data)
    {
        /** @var \Gerrie\Entity\Server $data */
        $this->log('Proceed Server');
        $this->log('Server "' . $data->name . '" (' . $data->host . ')');

        $serverId = $this->existsGerritServer($data->name, $data->host);

        // If the don`t know this server, save it!
        if ($serverId === false) {
            $serverData = array(
                'name' => $data->name,
                'host' => $data->host
            );
            $serverId = $this->getDatabase()->insertRecord(Database::TABLE_SERVER, $serverData);
            // TODO Implement "setServersFirstRun"
            // Maybe as decorator?
            // The purpose is to "block" updates in "serversFirstRun", because there should no update.
            // This is REALLY useful for debugging
            // Currently this feature is disabled, because of lazyness ;)
            // $this->setServersFirstRun();

            $this->log('=> Inserted (ID: ' . $serverId . ')');
        } else {
            $this->log('=> Exists');
        }

        $this->log('');

        return $serverId;
    }

    /**
     * Checks if the current importer is responsible for the given data.
     *
     * @param EntityInterface $data
     * @return boolean
     */
    public function isResponsible(EntityInterface $data)
    {
        /** @var \Gerrie\Entity\Server $data */
        return ($data->host && $data->name);
    }

    /**
     * Checks if a Gerrit server is known by our database.
     *
     * @param string $name Name of configured Gerrit server
     * @param string $host Host of configured Gerrit server
     * @return string
     */
    protected function existsGerritServer($name, $host)
    {
        $database = $this->getDatabase();
        $dbHandle = $database->getDatabaseConnection();

        $query = 'SELECT `id`
                  FROM ' . Database::TABLE_SERVER . '
                  WHERE `name` = :name AND `host` = :host LIMIT 1';

        $values = array(
            ':name' => $name,
            ':host' => $host
        );

        $statement = $dbHandle->prepare($query);
        $executeResult = $statement->execute($values);

        $statement = $database->checkQueryError($statement, $executeResult, $values);
        return $statement->fetchColumn();
    }
}