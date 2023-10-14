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

        return $db->query($sql);
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return array
     */
    public static function findAllByColumn(string $column, $value)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';
        $db = new Database();
        $db->setClassName(\get_called_class());

        return $db->query($sql, [':value' => $value]);
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return self|null
     */
    public static function findOneByColumn(string $column, $value): ?self
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value LIMIT 1';
        $db = new Database();
        $db->setClassName(\get_called_class());

        $res = $db->query($sql, [':value' => $value]);

        return $res[0] ?? null;
    }

    /**
     * @param array $columns
     * @return self|null
     */
    public static function findOneByColumns(array $columns): ?self
    {
        if (empty($columns)) {
            return null;
        }
        $firstColumn = \array_key_first($columns);
        $firstValue = \array_shift($columns);

        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $firstColumn . '=:' . $firstColumn;
        $values = [];
        foreach ($columns as $column => $value) {
            $sql .= ' AND '. $column . '=:' . $column;
            $values[':' . $column] = $value;
        }
        $sql .= ' LIMIT 1';
        $values = [':' . $firstColumn => $firstValue] + $values;

        $db = new Database();
        $db->setClassName(\get_called_class());

        $res = $db->query($sql, $values);

        return $res[0] ?? null;
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

        $res = $db->query($sql, [':id' => $id]);

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
     * @return void
     */
    public function update(): void
    {
        $cols = [];
        $data = [];
        foreach ($this->data as $key => $value) {
            $data[':' . $key] = $value;
            if ($key == 'id') {
                continue;
            }
            $cols[] = $key . '=:' . $key;
        }
        $sql = 'UPDATE ' . static::$table . ' SET ' . \implode(', ', $cols) . ' WHERE id=:id';
        $db = new Database();
        $db->execute($sql, $data);
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if (!isset($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * @return array
     */
    public function delete(): array
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();

        return $db->query($sql, [':id' => $this->id]);
    }
}
