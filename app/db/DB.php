<?php


namespace App\Db;

use PDO;

class DB
{

    private const DB_FILE_PATH = __DIR__ . '/beachbum.db';

    private static $instance;

    /**
     * @return PDO
     */
    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new PDO("sqlite:" . self::DB_FILE_PATH);
        }

        return self::$instance;
    }
}