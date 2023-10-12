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
     * @return array|false
     */
    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new Database();
        $db->setClassName(get_called_class());

        return $db->query($sql);
    }

    /**
     * @param mixed $id
     * @return self|false
     */
    public static function findOneById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();
        $db->setClassName(get_called_class());

        $res = $db->query($sql, [':id' => $id]);

        return $res[0] ?? false;
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
        $db->setClassName(get_called_class());

        return $db->query($sql, [':value' => $value]);
    }

    /**
     * @return array|false
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();

        return $db->query($sql, [':id' => $this->id]);
    }
}
