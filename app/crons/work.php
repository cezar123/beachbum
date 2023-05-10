<?php

use App\Controllers\TaskController;

$taskCount = 0;
$taskController = new TaskController();
$allTasks = $taskController->getTasksToExecuteGroupedByCommand();

if (!$allTasks) {
    echo "$taskCount tasks to execute";
    return;
}

foreach ($allTasks as $command => $tasks) {
    $workerClass = '\\App\\Workers\\' . ucfirst($command) . 'Worker';
    $worker = new $workerClass();
    $taskController->execute($worker, $tasks);
    $taskCount += count($tasks);
}

echo "$taskCount tasks executed";
return;