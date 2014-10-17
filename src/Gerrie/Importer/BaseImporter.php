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

use \Gerrie\Helper\Database;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseImporter implements ImporterInterface
{

    /**
     * Database
     *
     * @var \Gerrie\Helper\Database
     */
    private $database;

    /**
     * Logger
     *
     * TODO Implement a better logger (Monolog / Psr)
     *
     * @var OutputInterface
     */
    private $logger;

    /**
     * @param Database $database
     * @param OutputInterface $logger
     */
    public function __construct(Database $database, OutputInterface $logger) {
        $this->database = $database;
        $this->logger = $logger;
    }

    /**
     * Returns the database connection
     *
     * @return Database
     */
    protected function getDatabase()
    {
        return $this->database;
    }

    /**
     * Logs a message
     *
     * @param string $message
     * @return void
     */
    protected function log($message, $type = 1)
    {
        // Chose color type of message
        switch ($type) {
            case 2:
                $prefix = '<comment>';
                $postfix = '</comment>';
                break;

            case 3:
                $prefix = '<error>';
                $postfix = '</error>';
                break;

            case 1:
            default:
                $prefix = '<info>';
                $postfix = '</info>';
                break;
        }

        $this->logger->writeln($prefix . $message . $postfix);
    }
}