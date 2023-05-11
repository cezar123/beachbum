<?php


namespace App\Workers;

use App\Interfaces\WorkerInterface;
use App\Db\DB;


/**
 * Class AddWorker
 * @package App\Workers
 */
class AddWorker implements WorkerInterface
{

    // flag against memory leeks
    private $keepWorking = true;

    /**
     * @param array $tasks
     */
    public function execute($tasks)
    {
        while ($this->keepWorking) {
            $insert = 'INSERT INTO Done ("params") VALUES ';
            foreach (explode(",", $tasks["params"]) as $param) {
                $insert .= '("'.$param.'"),';
            }

            $insert = rtrim($insert, ",");
            DB::getInstance()->exec($insert);

            $delete = 'DELETE FROM Tasks WHERE id in (' . $tasks["ids"] . ')';
            DB::getInstance()->exec($delete);

            $this->keepWorking = false;
        }
    }
}