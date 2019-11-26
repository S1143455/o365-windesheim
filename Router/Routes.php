<?php


/**
 * ALL Routes the website uses will be defined here.
*/



$router->route('/', function(){
    return include 'content/home.php';
});

$router->route('/about', function(){
    return 'hello, world';
});

$router->resource('/product', 'product');


/**
 *  Execute the route
 */
$action = $_SERVER['REQUEST_URI'];
$router->dispatch($action);
