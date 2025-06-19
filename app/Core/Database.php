<?php

namespace App\Core;

require_once __DIR__.'/../../config.php';

class Database
{
    public static function connect(): \PDO
    {
        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

        try {
            return new \PDO($dsn, DB_USER, DB_PASS, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (\PDOException $e) {
            // Log the error or display a generic message
            exit('Database connection failed: '.$e->getMessage());
        }
    }
}
