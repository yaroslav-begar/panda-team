<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Model\View;

class Index extends AbstractController
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
