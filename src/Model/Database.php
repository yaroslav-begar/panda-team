<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

use Exception;
use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO
     */
    private PDO $dbh;

    /**
     * @var string
     */
    private string $className = 'stdClass';

    /**
     * @throws Exception
     * @throws PDOException
     */
    public function __construct()
    {
        $config = new Config();

        $this->dbh = new PDO(
            \sprintf('mysql:dbname=%s;host=%s', $config->getDbName(), $config->getDbHost()),
            $config->getDbUser(),
            $config->getDbPassword()
        );
    }

    /**
     * @param string $className
     * @return void
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    public function query(string $sql, array $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute(string $sql, array $params = []): bool
    {
        $sth = $this->dbh->prepare($sql);

        return $sth->execute($params);
    }

    /**
     * @return string|false
     */
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
