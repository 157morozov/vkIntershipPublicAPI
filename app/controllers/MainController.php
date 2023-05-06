<?php

namespace app\controllers;

use app\utils\Database;

class MainController
{
    public static function save($data)
    {
        $query_name = $data["query_name"];
        $user_auth_status = $data["user_auth_status"];
        if ($user_auth_status == "on" || $user_auth_status == true || $user_auth_status == "true" || $user_auth_status == 1 || $user_auth_status == "1") {
            $user_auth_status = 1;
        } else {
            $user_auth_status = 0;
        }
        $user_ip = $_SERVER['REMOTE_ADDR'];

        // SQL query
        mysqli_query(Database::connection(), "INSERT INTO `queries`(`query_name`, `user_auth_status`, `user_ip`) VALUES ('$query_name', '$user_auth_status', '$user_ip')");

        // Cors bypass headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

        // Send answer
        echo true;
    }

    public static function response($data)
    {
        $filter = $data["filter"];
        $value = $data["value"];

        // Choose a filter option
        switch ($filter) {
            case 'by_query_name':
                $data = mysqli_query(Database::connection(), "SELECT * FROM `queries` WHERE `query_name` = '$value'");
                $data = mysqli_fetch_all($data);
                if ($data == []) $data = "Error: This query name doesnt exists";
                break;
            case 'by_date':
                $data = mysqli_query(Database::connection(), "SELECT * FROM `queries` WHERE `timestamp` LIKE '$value%'");
                $data = mysqli_fetch_all($data);
                if ($data == []) $data = "Error: This date is empty";
                break;
            case 'by_user_ip':
                $data = mysqli_query(Database::connection(), "SELECT * FROM `queries` WHERE `user_ip` = '$value'");
                $data = mysqli_fetch_all($data);
                if ($data == []) $data = "Error: This ip address not found";
                break;
            case 'by_user_auth_status':
                if ($value == "on" || $value == true || $value == "true" || $value == 1 || $value == "1") {
                    $value = 1;
                } else {
                    $value = 0;
                }
                $data = mysqli_query(Database::connection(), "SELECT * FROM `queries` WHERE `user_auth_status` = '$value'");
                $data = mysqli_fetch_all($data);
                if ($data == []) $data = "Error: Not found";
                break;
        }

        // Cors bypass headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

        // Send answer
        echo json_encode($data);
    }
}
