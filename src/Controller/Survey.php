<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Exception;
use Model\Answer;
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
     * @return void
     */
    public function actionCreate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // TODO: Save data + redirect to /survey/all
        } else {
            $view = new View();
            $view->title = 'Create survey';
            $view->display('survey/update');
        }
    }

    /**
     * @param mixed $id
     * @return void
     */
    public function actionUpdate($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // TODO: Load data + replace data + redirect to /survey/all
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
