<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

class AbstractModel
{
    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new Database();
        $db->setClassName(get_called_class());

        return $db->query($sql);
    }
}
