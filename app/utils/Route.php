<?php

namespace app\utils;

class Route
{
    public static $queries = [];

    public static function get($uri, $page)
    {
        self::$queries[] = [
            'uri' => $uri,
            'page' => $page,
        ];
    }

    public static function post($uri, $controller, $method, $data = false, $file = false)
    {
        self::$queries[] = [
            'uri' => $uri,
            'class' => $controller,
            'method' => $method,
            'data' => $data,
            'file' => $file,
        ];
    }

    public static function init()
    {
        $current_query = $_GET['q'];

        foreach (self::$queries as $query) {
            if ($query['uri'] == '/' . $current_query) {
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        require_once('views/' . $query['page'] . '.php');
                        die();

                    case 'POST':
                        if ($_POST) {
                            $post = $_POST;
                        } else {
                            $post = json_decode(file_get_contents('php://input'), true);
                        }
                        switch ($query['method']) {
                            case 'save':
                                $action = new $query['class'];
                                $method = $query['method'];
                                $action->$method($post);
                                die();
                            case 'response':
                                $action = new $query['class'];
                                $method = $query['method'];
                                $action->$method($post);
                                die();
                        }
                        die();
                }
            }
        }
    }
}
