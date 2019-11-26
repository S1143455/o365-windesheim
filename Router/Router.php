<?php

namespace Router;

class Router
{

    private $routes;
    private $method;
    function __construct()
    {
        $this->routes = [];


    }

    public function route($action, \Closure $callback)
    {
        $action = trim($action, '/');
        $this->routes[$action] = $callback;
        print_r($this->routes);
    }

    public function dispatch($action)
    {
        $action = trim($action, '/');
        if (array_key_exists($action, $this->routes)) {
            $callback = $this->routes[$action];
            if(array_key_exists($this->method , $callback)){

            }
            echo call_user_func($callback);
        } else {
            header("404 Not Found");
        }
    }

    public function resource($action, $resource)
    {

        echo $action;
        $action = preg_split('/[^\/].[^\/]+/',$action,1);
        print_r([$action,$resource]);
//        $action = trim ($resource[0]);
//        $this->method = trim($resource[1]);
//        $this->routes[$action][$this->method] = $callback;



    }

}