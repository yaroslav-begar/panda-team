<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

/**
 * @property $id
 * @property $email
 * @property $password
 */
class User extends AbstractModel
{
    /**
     * @var string
     */
    protected static string $table = 'user';

    /**
     * @var string
     */
    protected static string $class = 'User';
}
