<?php


/**
 * ALL Routes the website uses will be defined here.
*/



$router->route('/', function(){
    return include 'content/frontend/home.php';
});

$router->route('/about', function(){
    return 'hello, world';
});

$router->route('/about-us', function(){
    return include 'content/frontend/about-us.php';
});

$router->route('/admin', function(){
    return include 'content/backend/home-admin.php';
});




$router->resource('/product', 'product');

/**
 *  Execute the route
 */

$action = $_SERVER['REQUEST_URI'];
$router->dispatch($action);

