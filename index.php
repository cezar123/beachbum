<?php
require __DIR__.'/vendor/autoload.php';

$controller = 'App\\Controllers\\' . filter_var($_POST['controller'], FILTER_SANITIZE_ENCODED);
$method = filter_var($_POST['method'], FILTER_SANITIZE_ENCODED);

try {
    $controller = new $controller();
    $controller->processRequest();
    $response = $controller->{$method}();
    $response->send();
} catch (Exception $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
    exit();
}









?>