<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Model\Database;
use Model\User;
use Model\Question;

class Api
{
    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function actionGetRandomSurvey(string $email, string $password): string
    {
        $user = User::findOneByColumns(['email' => $email, 'password' => \md5($password)]);
        if (!$user) {
            echo \json_encode(['error' => \sprintf('User with these credentials not found: "%s", "%s".', $email, $password)]);
        }

        $questions = Question::findAllByColumn('user_id', $user->id);
        $questionIds = [];
        /** @var Question $question */
        foreach ($questions as $question){
            $questionIds[] = $question->id;
        }
        $randomQuestionId = $questionIds[\array_rand($questionIds)];

        $sql = 'SELECT q.id as question_id, q.text AS question, q.status AS status, a.text AS answer, a.votes_number AS votes
                FROM question q
                LEFT JOIN answer a ON q.id = a.question_id
                WHERE q.id = :id';
        $db = new Database();
        $db->setClassName('stdClass');
        $data = $db->query($sql, [':id' => $randomQuestionId]);

        $result = [];
        /** @var \stdClass $value */
        foreach ($data as $key => $value) {
            $result[$value->question][$key]['answer'] = $value->answer;
            $result[$value->question][$key]['votes']  = $value->votes;
        }

        echo \json_encode($result);
    }
}
