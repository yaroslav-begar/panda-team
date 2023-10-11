<?php

namespace Model;

class Config
{
    /**
     * @var array
     */
    private $dbConnection;

    public function __construct()
    {
        $config = $this->getConfig();
        $this->dbConnection = $config['db_connection'];
    }

    /**
     * @return array
     */
    public function getDbConnection(): array
    {
        return $this->dbConnection;
    }

    /**
     * @return array
     */
    private function getConfig(): array
    {
        return require_once __DIR__ . '/../../config/config.php';
    }
}
