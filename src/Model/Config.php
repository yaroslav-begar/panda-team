<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

use Exception;

class Config
{
    /**
     * @var array
     */
    private array $config;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->config = $this->getConfig();
    }

    /**
     * @return string
     */
    public function getDbHost(): string
    {
        return $this->getDbConnection()['host'];
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->getDbConnection()['dbname'];
    }

    /**
     * @return string
     */
    public function getDbUser(): string
    {
        return $this->getDbConnection()['user'];
    }

    /**
     * @return string
     */
    public function getDbPassword(): string
    {
        return $this->getDbConnection()['password'];
    }

    /**
     * @return array
     */
    private function getDbConnection(): array
    {
        return $this->config['db_connection'];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getConfig(): array
    {
        $file = __DIR__ . '/../../config/config.php';
        if (!\file_exists($file) || !\is_readable($file)) {
            throw new Exception('Configuration file is not available.');
        }

        return require $file;
    }
}
