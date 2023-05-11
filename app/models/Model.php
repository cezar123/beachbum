<?php


namespace App\Models;

use App\Db\DB;
use PDO;

/**
 * Class Model
 */
class Model
{
    protected $db;

    /**
     * Model constructor.
     */
    protected function __construct()
    {
        $this->db = DB::getInstance();
    }
}