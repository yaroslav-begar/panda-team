<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Model;

/**
 * @property $id
 * @property $question_id
 * @property $text
 * @property $votes_number
 */
class Answer extends AbstractModel
{
    /**
     * @var string
     */
    protected static string $table = 'answer';

    /**
     * @var string
     */
    protected static string $class = 'Answer';
}
