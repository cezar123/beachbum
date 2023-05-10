<?php


namespace App\Controllers;

use App\Interfaces\WorkerInterface;
use App\Models\Task;

class TaskController
{
    public function add($command, $executeAt, $params){
        $task = new Task($executeAt, $params, $worker);
        return $task->save();
    }

    public function getTasksToExecuteGroupedByCommand(){
        return Task::where('execute_at', '<=', date());
    }

    public function execute(WorkerInterface $worker, $tasks){
        $worker->execute($tasks);
    }

}