<?php


namespace App\Controllers;

use App\Interfaces\WorkerInterface;
use App\Models\Task;

class TaskController
{
    public function add($command, $executeAt, $params){
        $task = new Task($command, $executeAt, $params);
        return $task->save();
    }

    public function getTasksToExecuteGroupedByCommand(){
        $now = new \DateTime('now', new \DateTimeZone('Asia/Jerusalem'));
        return Task::where('execute_at', '<=', $now->format('Y-m-d H:i'));
    }

    public function execute(WorkerInterface $worker, $tasks){
        $worker->execute($tasks);
    }

}