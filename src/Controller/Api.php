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
     * Example1: {"Some question 1":[{"answer":"Some answer 1","votes":"1"},{"answer":"Some answer 2","votes":"2"}]}
     * Example2: {"Some question 2":[]}
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function actionGetRandomSurvey(string $email, string $password): void
    {
        $user = User::findOneByColumns(['email' => $email, 'password' => \md5($password)]);
        if (!$user) {
            echo \json_encode(['error' => \sprintf('User with these credentials not found: "%s", "%s".', $email, $password)]);
            return;
        }

        $questions = Question::findAllByColumn('user_id', $user->id);
        $questionIds = [];
        /** @var Question $question */
        foreach ($questions as $question){
            $questionIds[] = $question->id;
        }
        if (empty($questionIds)) {
            echo \json_encode(['error' => \sprintf('No surveys found for "%s".', $email)]);
            return;
        }
        $randomQuestionId = $questionIds[\array_rand($questionIds)];

        $sql = 'SELECT q.id as question_id, q.text AS question, a.text AS answer, a.votes_number AS votes
                FROM question q
                LEFT JOIN answer a ON q.id = a.question_id
                WHERE q.id = :id';
        $db = new Database();
        $db->setClassName('stdClass');
        $data = $db->query($sql, [':id' => $randomQuestionId]);

        $result = [];
        /** @var \stdClass $value */
        foreach ($data as $key => $value) {
            if (isset($value->answer, $value->votes)) {
                $result[$value->question][$key]['answer'] = $value->answer;
                $result[$value->question][$key]['votes']  = $value->votes;
            } else {
                $result[$value->question] = [];
            }
        }

        echo \json_encode($result);
    }
}
