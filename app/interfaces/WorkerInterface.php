<?php


namespace App\Interfaces;


/**
 * Interface WorkerInterface
 * @package App\Interfaces
 */
interface WorkerInterface
{
    /**
     * @param $tasks
     * @return string
     */
    public function execute($tasks);
}