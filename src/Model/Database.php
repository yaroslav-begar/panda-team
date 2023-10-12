<?php
/** @noinspection ALL */

namespace Model;

use PDO;

class Database
{
    /**
     * @var PDO
     */
    private PDO $dbh;

    public function __construct()
    {
        $config = new Config();

        $this->dbh = new PDO(
            \sprintf('mysql:dbname=%s;host=%s', $config->getDbName(), $config->getDbHost()),
            $config->getDbUser(),
            $config->getDbPassword()
        );
    }
}
