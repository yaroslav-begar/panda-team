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
        $this->redirectIfNoSessionUserExist();

        $user = User::findOneByColumn('email', $_SESSION['user']);

        $questions = Question::findAllByColumn('user_id', $user->id);
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
        $this->redirectIfNoSessionUserExist();

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
        $this->redirectIfNoSessionUserExist();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['status'])
            && \array_key_exists($status = (int)$_POST['status'], Question::STATUSES)
            && !empty($_POST['text'])
        ) {
            $text = $_POST['text'];

            $user = User::findOneByColumn('email', $_SESSION['user']);

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
        $this->redirectIfNoSessionUserExist();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['status'])
            && \array_key_exists($status = (int)$_POST['status'], Question::STATUSES)
            && !empty($_POST['text'])
        ) {
            $text = $_POST['text'];

            $question = Question::findOneById($id);
            if (!$question) {
                throw new Exception(\sprintf('Survey with ID "%d" cannot be updated.', $id));
            }
            $question->status = $status;
            $question->text = $text;
            $question->update();

            // TODO: Substitution by deletion and insertion - use AJAX instead
            $answers = Answer::findAllByColumn('question_id', $question->id);
            foreach ($answers as $answer) {
                $answer->delete();
            }

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
        $this->redirectIfNoSessionUserExist();

        $question = Question::findOneById($id);
        if (!$question) {
            throw new Exception(\sprintf('Survey with ID "%d" cannot be deleted.', $id));
        }
        $question->delete();
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
