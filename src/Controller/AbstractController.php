<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

class AbstractController
{
    public function __construct()
    {
        \session_start();
    }

    /**
     * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        \header('Location: ' . $url);
    }

    /**
     * @return void
     */
    protected function redirectIfSessionUserExist(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/survey/all');
        }
    }

    /**
     * @return void
     */
    protected function redirectIfNoSessionUserExist(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/index/index');
        }
    }
}
