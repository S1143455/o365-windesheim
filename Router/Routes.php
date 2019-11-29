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

$router->route('/about-us', function(){
    return  include 'content/about-us.php';
});

$router->route('/login', function(){
    return  include 'views/login/login.php';
});

$router->route('/register', function(){
    return  include 'views/register.php';
});



$router->resource('/product', 'product');

/**
 *  Execute the route
 */

$action = $_SERVER['REQUEST_URI'];
$router->dispatch($action);

