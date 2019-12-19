<?php

namespace app;

class DB
{

    public static function getConnection()
    {

        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        try {
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
            $db = new \PDO($dsn, $params['user'], $params['password']);
            return $db;
        } catch (PDOException $e) {
            printme(' connect to MySQL failed', 1);
            printme("Error: " . $e->getMessage());
            //  exit();
        }

    }

}