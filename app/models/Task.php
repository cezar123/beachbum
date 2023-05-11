<?php


namespace App\Models;

use App\Models\Model;
use Exception;


/**
 * Class Task
 * @package App\Models
 */
class Task extends Model
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
        parent::__construct();
        $this->command = $command;
        $this->executeAt = $executeAt;
        $this->params = $params;
    }

    /**
     * @return bool
     */
    public function save(){
        $sql = "INSERT INTO Tasks (id, command , execute_at, params) VALUES (NULL, '".$this->command."', '".$this->executeAt."', '".$this->params."')";
        return $this->db->exec($sql);

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

}