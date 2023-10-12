<?php
/**
 * @noinspection ALL
 */

use Model\View;

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../config/config.php';

$path = \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = \explode('/', $path);

$controller = !empty($pathParts[1]) ? \ucfirst($pathParts[1]) : 'Index';
$action = !empty($pathParts[2]) ? \ucfirst($pathParts[2]) : 'Index';
$parameter = !empty($pathParts[3]) ? $pathParts[3] : null;
$value = !empty($pathParts[4]) ? $pathParts[4] : null;

$className = 'Controller\\' . $controller;
$methodName = 'action' . $action;

try {
    if (isset($parameter, $value)) {
        (new $className())->$methodName($value);
    } else {
        (new $className())->$methodName();
    }
} catch(\Throwable $e) {
    // TODO: Log error code, message, etc.
    $view = new View();
    $view->title = 'Error';
    $view->error = 'Unexpected error';
    $view->display('error');
}
