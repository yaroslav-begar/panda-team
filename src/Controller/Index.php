<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

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
