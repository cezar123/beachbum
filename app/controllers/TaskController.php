<?php


namespace App\Controllers;

use App\Interfaces\WorkerInterface;
use App\Models\Task;

/**
 * Class TaskController
 * @package App\Controllers
 */
class TaskController
{
    /**
     * @param $command
     * @param $executeAt
     * @param $params
     * @return bool
     */
    public function add($command, $executeAt, $params){
        $task = new Task($command, $executeAt, $params);
        return $task->save();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTasksToExecuteGroupedByCommand(){
        $now = new \DateTime('now', new \DateTimeZone('Asia/Jerusalem'));
        return Task::where('execute_at', '<=', $now->format('Y-m-d H:i'));
    }

    /**
     * @param WorkerInterface $worker
     * @param Task[] $tasks
     */
    public function execute(WorkerInterface $worker, $tasks){
        $worker->execute($tasks);
    }

}