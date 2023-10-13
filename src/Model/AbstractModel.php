<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

class AbstractModel
{
    /**
     * @var string
     */
    protected static string $table;

    /**
     * @var string
     */
    protected static string $class;

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->data[$key];
    }

    /**
     * @param string $property
     * @return bool
     */
    public function __isset($property): bool
    {
        return isset($this->data[$property]);
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new Database();
        $db->setClassName(\get_called_class());

        return $db->query($sql); // Массив объектов или пустой массив
    }

    /**
     * @param string $colomn
     * @param mixed $value
     * @return array
     */
    public static function findAllByColomn(string $colomn, $value)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $colomn . '=:value';
        $db = new Database();
        $db->setClassName(\get_called_class());

        return $db->query($sql, [':value' => $value]); // Массив объектов или пустой массив
    }



    public static function findOneByColomn(string $colomn, $value)
    {
        // TODO: Implement
    }

    public static function findOneByColomns(array $colomns)
    {
        // TODO: Implement
    }



    /**
     * @param mixed $id
     * @return self|null
     */
    public static function findOneById($id): ?self
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();
        $db->setClassName(\get_called_class());

        $res = $db->query($sql, [':id' => $id]); // Массив объектов или пустой массив

        return $res[0] ?? null;
    }

    /**
     * @return void
     */
    public function insert(): void
    {
        $cols = \array_keys($this->data);
        $data = [];
        foreach($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }
        $sql = 'INSERT INTO ' . static::$table . ' (' . \implode(', ', $cols) . ') 
			VALUES (' . \implode(', ', \array_keys($data)) . ')';
        $db = new Database();
        $db->execute($sql, $data);
        $this->id = $db->lastInsertId();
    }

    /**
     * @return array
     */
    public function delete(): array
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();

        return $db->query($sql, [':id' => $this->id]); // Пустой массив
    }
}
