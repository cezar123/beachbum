<?php


namespace App\Lib;


class Response
{
    private $toSend;
    private $error;

    /**
     * Response constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->toSend = $data;
    }

    public function send(){
        echo $this->toSend;
    }
}