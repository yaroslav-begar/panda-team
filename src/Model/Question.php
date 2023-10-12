<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

/**
 * @property $id
 * @property $user_id
 * @property $text
 * @property $status
 * @property $created_at
 */
class Question extends AbstractModel
{
    /**
     * @var string
     */
    protected static string $table = 'question';

    /**
     * @var string
     */
    protected static string $class = 'Question';
}
