<?php


namespace App\Models;


/**
 * Class Task
 * @package App\Models
 */
class Task
{
    private $id;
    private $command;
    private $executeAt;
    private $params;

    /**
     * Task constructor.
     * @param string $command
     * @param string $executeAt
     * @param string $params
     */
    public function __construct($command, $executeAt, $params)
    {
        $this->command = $command;
        $this->executeAt = $executeAt;
        $this->params = $params;
    }

    /**
     * @return bool
     */
    public function save(){
        // save task to db
        return true;
    }

    /**
     * @return bool
     */
    /**
     * @return bool
     */
    public function delete(){
        // delete task
        return true;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return array
     */
    public static function where($column, $operator, $value){
        $tasks = [];

        // get tasks

        return $tasks;
    }


}