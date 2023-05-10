<?php


namespace App\Workers;

use App\Interfaces\WorkerInterface;


class AddWorker implements WorkerInterface
{

    // flag against memory leeks
    private $keepWorking = true;

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