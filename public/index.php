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
        if ($_SERVER['REQUEST_METHOD'] == 'GET'
            && !empty($_GET['email'])
            && !empty($_GET['password'])
        ) {
            (new $className())->$methodName($_GET['email'], $_GET['password']);
        } else {
            (new $className())->$methodName();
        }
    }
} catch(\Exception $e) {
    // TODO: Add message processing
    $view = new View();
    $view->title = 'Error page';
    $view->error = $e->getMessage();
    $view->display('error');
} catch(\Throwable $e) {
    // TODO: Log error code, message, etc.
    $view = new View();
    $view->title = 'Error page';
    $view->error = 'Unexpected error.';
    $view->display('error');
}
