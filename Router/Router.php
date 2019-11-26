<?php

namespace Router;

class Router
{

    private $routes;

    function __construct()
    {
        $this->routes = [];

    }

    public function route($action, \Closure $callback)
    {
        $action = trim($action, '/');
        $this->routes[$action] = $callback;
    }

    public function dispatch($action)
    {
        $action = trim($action, '/');
        if (array_key_exists($action, $this->routes)) {
            $callback = $this->routes[$action];
            echo call_user_func($callback);
        } else {
            header("404 Not Found");
        }
    }

}