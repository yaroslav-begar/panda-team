<?php
/** @noinspection ALL */

namespace Controller;

use Model\View;

class Index
{
    /**
     * @return void
     */
    public function actionIndex(): void
    {
        $view = new View();
        $view->title = 'Index';
        $view->display('index');
    }
}
