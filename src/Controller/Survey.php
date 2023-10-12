<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Model\View;
use Model\Question;

class Survey
{
    /**
     * @return void
     */
    public function actionAll(): void
    {
        $questions = Question::findAll();
        $view = new View();
        $view->title = 'Cabinet';
        $view->items = $questions;
        $view->display('survey/all');
    }
}
