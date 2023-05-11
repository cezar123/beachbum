<?php


namespace App\Controllers;

use App\Db\DB;
use App\Interfaces\WorkerInterface;
use App\Lib\Response;
use App\Models\Task;
use DateTime;
use DateTimeZone;
use DateInterval;
use Exception;
use InvalidArgumentException;

/**
 * Class TaskController
 */
class TaskController
{

    private $command;

    private $executeAt;

    private $params;

    /**
     *
     */
    public function add(){
        $task = new Task($this->command, $this->executeAt, $this->params);
        $task->save();
        return new Response('Task added to queue');
    }

    /**
//     * @return array
     * @throws Exception
     */
    public function getTasksToExecuteGroupedByCommand(){
        $now = new \DateTime('now', new \DateTimeZone('Asia/Jerusalem'));
        $sql = "SELECT command, GROUP_CONCAT(id) as ids, GROUP_CONCAT(params) as params FROM Tasks WHERE execute_at <= ".$now->getTimestamp()." GROUP BY command";

        $statement = DB::getInstance()->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * @param WorkerInterface $worker
     * @param Task[] $tasks
     */
    public function execute(WorkerInterface $worker, $tasks){
        $worker->execute($tasks);
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function processRequest(){

        if (!array_key_exists('task', $_POST) || empty($_POST['task'])) {
            throw new Exception('Bad request');
        }

        // extract and sanitize command
        preg_match('/:(\w+)/', $_POST['task'], $matchCommand);
        $this->command = filter_var($matchCommand[1], FILTER_SANITIZE_ENCODED);

        if (!$this->command) {
            throw new InvalidArgumentException('Command parameter could not be extracted');
        }

        // extract executeAt
        preg_match('/\+(\d+)([a-z]+)/', $_POST['task'], $matchExecuteAt);
        $executeAtNumber = $matchExecuteAt[1];
        $executeAtUnit = $matchExecuteAt[2];
        $now = new DateTime('now', new DateTimeZone('Asia/Jerusalem'));
        $now->add(new DateInterval('PT' . $executeAtNumber . strtoupper($executeAtUnit)));
        $this->executeAt = $now->getTimestamp();
        if (!$this->executeAt) {
            throw new InvalidArgumentException('ExecuteAt parameter could not be extracted');
        }

        // get what's inside quotes and sanitize
        preg_match('/"([^"]*)"/', $_POST['task'], $matchParams);
        $this->params = filter_var($matchParams[1], FILTER_SANITIZE_ENCODED);
        if (!$this->params) {
            throw new InvalidArgumentException('Params parameter could not be extracted');
        }

    }

}