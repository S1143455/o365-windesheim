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

/**
 * Routes for the product
 */
$router->route('/product', function() use($product){
    return $product->index();
});
$router->route('/product/create', function() use($product){
    return $product->create();
});



$router->resource('/product', 'product');

/**
 *  Execute the route
 */

$action = $_SERVER['REQUEST_URI'];
$router->dispatch($action);

