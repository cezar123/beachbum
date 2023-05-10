<?php


namespace App\Workers;

use App\Interfaces\WorkerInterface;


/**
 * Class AddWorker
 * @package App\Workers
 */
class AddWorker implements WorkerInterface
{

    // flag against memory leeks
    private $keepWorking = true;

    /**
     * @param Task[] $tasks
     */
    public function execute($tasks)
    {
        while ($this->keepWorking) {
            foreach ($tasks as $task) {
                // save to tasks done
            }
            $this->keepWorking = false;
        }
    }
}