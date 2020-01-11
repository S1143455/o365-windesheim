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
    }

    public function dispatch($action)
    {
        $id = null;
        if($this->root != ""){
            $action = str_replace($this->root,'',$action);
        }
        $action = trim($action, '/');

        if (array_key_exists($action, $this->routes))
        {
            $callback = $this->routes[$action];
            call_user_func($callback);
        }

        else if(preg_match('/\/(?:.(?!\/))+$/', $action,$matches))
        {
            $action = str_replace($matches[0], '', $action)."/{id}";
            if(array_key_exists($action, $this->routes))
            {
                $callback = $this->routes[$action];
                $id = $matches[0];
                call_user_func($callback,trim($id,'/'));
            }
            else
                {
                    header("Location: /404");
                }
        }

        else {
            if (!strpos($_SERVER['REQUEST_URI'],'passwordrecovery'))
            {
                header("Location: /404");
            }
            else
            {
                $_POST['recoverystring']=str_replace(strtok($_SERVER['REQUEST_URI'],'?').'?','',$_SERVER['REQUEST_URI']);    strtok($_SERVER['REQUEST_URI'],'?'); // $_SERVER['REQUEST_URI'], 2);
                return include "content/frontend/passwordrecovery.php";
            }
        }
    }

}