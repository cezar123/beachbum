<?php

require_once('DB.php');

class Migrations
{
    public static function run()
    {
        $pdo = \App\Db\DB::getInstance();

        $sql =
            "CREATE TABLE IF NOT EXISTS Tasks
          (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
          command       TEXT      NOT NULL,
          execute_at    INTEGER   NOT NULL,
          params        TEXT      NOT NULL);
          
          CREATE TABLE IF NOT EXISTS Done
          (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
          params        TEXT    NOT NULL);";


        try {
            $pdo->exec($sql);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}

Migrations::run();