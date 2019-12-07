<?php

namespace Router;

class Router
{

    private $routes;
    private $method;
    private $root;
    function __construct()
    {
        $this->routes = [];
        $this->root = getenv('ROOT');

    }

    public function route($action, \Closure $callback)
    {
        $action = trim($action, '/');
        $this->routes[$action] = $callback;
//        print_r($this->routes);
    }

    public function dispatch($action)
    {
        $id = null;
        if($this->root != ""){
            $action = str_replace($this->root,'',$action);
        }
        $action = trim($action, '/');


        if (array_key_exists($action, $this->routes)) {
            $callback = $this->routes[$action];
            if(array_key_exists($this->method , $callback)){

            }
            call_user_func($callback);
        }
        else if(preg_match('/\/(?:.(?!\/))+$/', $action,$matches))
        {
            $action = str_replace($matches[0], '', $action)."/{id}";
            print_r($action);
            if(array_key_exists($action, $this->routes))
            {
                $callback = $this->routes[$action];
                $id = $matches[0];
            }
            call_user_func($callback,trim($id,'/'));
        }

        else {
            header("404 Not Found");
        }
    }

    public function resource($action, $resource)
    {
        $action = preg_split('/[^\/].[^\/]+/',$action,1);
//        print_r([$action,$resource]);
//        $action = trim ($resource[0]);
//        $this->method = trim($resource[1]);
//        $this->routes[$action][$this->method] = $callback;



    }

}