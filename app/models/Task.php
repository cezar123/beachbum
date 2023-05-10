<?php


namespace App\Models;


/**
 * Class Task
 * @package App\Models
 */
class Task
{
    private $id;
    private $executeAt;
    private $params;
    private $worker;

    public function __construct($executeAt, $params, $worker)
    {
        $this->executeAt = $executeAt;
        $this->params = $params;
        $this->worker = $worker;
    }

    public function save(){
        // save task to db
        return true;
    }

    public function delete(){
        // delete task
        return true;
    }

    public static function where($column, $operator, $value){
        $tasks = [];

        // get tasks

        return $tasks;
    }


}