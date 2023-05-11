<?php
require __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../controllers/TaskController.php';

$taskCount = 0;
$taskController = new \App\Controllers\TaskController();

try {
    \App\Db\DB::getInstance()->exec('BEGIN TRANSACTION');
    $result = $taskController->getTasksToExecuteGroupedByCommand();

    if (!$result) {
        throw new Exception('No tasks to execute');
    }

    $workerClass = '\\App\\Workers\\' . ucfirst($result["command"]) . 'Worker';
    $worker = new $workerClass();
    $taskController->execute($worker, $result);
} catch (Exception $e) {
    echo $e->getMessage();
    \App\Db\DB::getInstance()->exec('ROLLBACK');
    exit();
}

\App\Db\DB::getInstance()->exec('COMMIT');

$count = count(explode(",", $result["ids"]));
echo "$count tasks executed";
return;