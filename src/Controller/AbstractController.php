<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

class AbstractController
{
    /**
     * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
    }
}
