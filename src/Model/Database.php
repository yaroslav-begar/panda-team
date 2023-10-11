<?php
/** @noinspection ALL */

namespace Model;

use Exception;
use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO
     */
    private $dbh;

    public function __construct()
    {
        $config = new Config();
        $connection = $config->getDbConnection();

        try{
            $this->dbh = new PDO(
                \sprintf('mysql:dbname=%s;host=%s', $connection['dbname'],  $connection['host']),
                $connection['user'],
                $connection['password']
            );
        } catch (PDOException $e) {
            // TODO: Log error
            throw new Exception('Unable to connect to database.');
        }
    }
}
