<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Exception;
use Model\Answer;
use Model\User;
use Model\View;
use Model\Question;

class Survey extends AbstractController
{
    /**
     * @return void
     */
    public function actionAll(): void
    {
        $questions = Question::findAll();
        $view = new View();
        $view->title = 'Cabinet';
        $view->questions = $questions;
        $view->display('survey/all');
    }

    /**
     * @param mixed $id
     * @return void
     */
    public function actionView($id): void
    {
        $question = Question::findOneById($id);
        if (!$question) {
            throw new Exception(\sprintf('Survey with ID "%d" cannot be viewed.', $id));
        }
        $answers = Answer::findAllByColumn('question_id', $id);

        $view = new View();
        $view->title = 'View survey #' . $id;
        $view->question = $question;
        $view->answers = $answers;
        $view->display('survey/view');
    }

    /**
     * @todo Sanitize input
     * @return void
     */
    public function actionCreate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['status'])
            && \array_key_exists($status = (int)$_POST['status'], Question::STATUSES)
            && !empty($text = $_POST['text'])
        ) {
            $user = User::findOneByColumn('email', 'asd@mail.ru'); // $_SESSION['user']

            $question = new Question();
            $question->user_id = $user->id;
            $question->status = $status;
            $question->text = $text;
            $question->insert();

            if (isset($_POST['answer'])) {
                foreach ($_POST['answer'] as $value) {
                    if (!empty($text = $value['text']) && !empty($votesNumber = $value['votes_number'])) {
                        $answer = new Answer();
                        $answer->question_id = $question->id;
                        $answer->text = $text;
                        $answer->votes_number = $votesNumber;
                        $answer->insert();
                    }
                }
            }

            $this->redirect('/survey/all');
        } else {
            $view = new View();
            $view->title = 'Create survey';
            $view->display('survey/update');
        }
    }

    /**
     * @todo Sanitize input
     * @param mixed $id
     * @return void
     */
    public function actionUpdate($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['status'])
            && \array_key_exists($status = (int)$_POST['status'], Question::STATUSES)
            && !empty($text = $_POST['text'])
        ) {
            $user = User::findOneByColumn('email', 'asd@mail.ru'); // $_SESSION['user']

            $question = Question::findOneById($id);
            if (!$question) {
                throw new Exception(\sprintf('Survey with ID "%d" cannot be updated.', $id));
            }
            $question->id = $id;
            $question->user_id = $user->id;
            $question->status = $status;
            $question->text = $text;
            $question->update();

            if (isset($_POST['answer'])) {
                foreach ($_POST['answer'] as $value) {
                    if (!empty($text = $value['text']) && !empty($votesNumber = $value['votes_number'])) {
                        $answer = new Answer();
                        if (!empty($id = $value['id'])) {
                            $answer->id = $id;
                        }
                        $answer->question_id = $question->id;
                        $answer->text = $text;
                        $answer->votes_number = $votesNumber;
                        $answer->save();
                    }
                }
            }

            $this->redirect('/survey/all');
        } else {
            $question = Question::findOneById($id);
            if (!$question) {
                throw new Exception(\sprintf('Survey with ID "%d" cannot be loaded to update.', $id));
            }
            $answers = Answer::findAllByColumn('question_id', $id);

            $view = new View();
            $view->title = 'Update survey #' . $id;
            $view->question = $question;
            $view->answers = $answers;
            $view->display('survey/update');
        }
    }

    /**
     * @param mixed $id
     * @return void
     */
    public function actionDelete($id): void
    {
        $question = Question::findOneById($id);
        if (!$question) {
            throw new Exception(\sprintf('Survey with ID "%d" cannot be deleted.', $id));
        }
        $question->delete();
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
