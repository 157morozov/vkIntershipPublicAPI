<?php

namespace app\utils;

class Database
{
    public static function connection()
    {
        $database = mysqli_connect("127.0.0.1:3307", "root", "", "api");
        if ($database) {
            return $database;
        } else {
            die("Database connection failed");
        }
    }
}