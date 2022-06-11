<?php


namespace App\Lib;

class Route
{
    public static function get($route, $callback, $params = [])
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback, $params);
    }

    public static function post($route, $callback, $params = [])
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $callback, $params);
    }

    public static function on($regex, $cb, $props = [])
    {
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;

        $regex = str_replace('/', '\/', $regex);

        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            // first value is normally the route
            array_shift($matches);

            // Get the matches as parameters
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $urlProps = [];
            foreach ($params as $key => $value) {

                $urlProps[$props[$key]] = $value;
            }

            [$controller, $method] = $cb;

            $instance = new $controller();

            call_user_func_array([$instance, $method], [new Request($urlProps), new Response()]);
        }
    }
}
