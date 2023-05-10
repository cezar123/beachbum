<?php
require __DIR__.'/vendor/autoload.php';

// todo - check autoload for controllers
include 'app/controllers/TaskController.php';

// get what's inside quotes and sanitize
preg_match('/"([^"]*)"/', $_POST['task'], $matchParams);
$params = filter_var($matchParams[1], FILTER_SANITIZE_ENCODED);

// extract and sanitize command
preg_match('/:(\w+)/', $_POST['task'], $matchCommand);
$command = filter_var($matchCommand[1], FILTER_SANITIZE_ENCODED);

// extract executeAt
preg_match('/\+(\d+)([a-z]+)/', $_POST['task'], $matchExecuteAt);
$executeAtNumber = $matchExecuteAt[1];
$executeAtUnit = $matchExecuteAt[2];
$now = new DateTime('now', new DateTimeZone('Asia/Jerusalem'));
$now->add(new DateInterval('PT' . $executeAtNumber . strtoupper($executeAtUnit)));
$executeAt = $now->format('Y-m-d H:i');

$controller = filter_var($_POST['controller'], FILTER_SANITIZE_ENCODED);
$method = filter_var($_POST['method'], FILTER_SANITIZE_ENCODED);

try {
    $controller = new $controller($command, $executeAt, $params);
    $controller->{$method}();
} catch (Exception $e) {
    echo $e->getMessage();
}


?>