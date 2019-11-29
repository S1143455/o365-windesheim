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

/**
 * Routes for the product
 */
$router->route('/product', function() use($product){
    return $product->index();
});
$router->route('/product/create', function() use($product){
    return $product->create();
});

$router->route('/admin/onderhoud', function(){
    return include 'content/backend/onderhoud-admin.php';
});

$router->route('/admin/onderhoud-hoofdpagina', function(){
    return include 'content/backend/onderhoudhoofdpagina.php';
});

$router->route('/admin', function(){
    return include 'content/backend/home-admin.php';
});

$router->route('/admin/onderhoud-categorieen', function(){
    return include 'content/backend/onderhoudc.php';
});

$router->route('/admin/onderhoud-producten', function(){
    return include 'content/backend/onderhoudproducten.php';
});

$router->route('/admin/onderhoud-klanten', function(){
    return include 'content/backend/onderhoudklanten.php';
});

$router->route('/admin/onderhoud-korting', function(){
    return include 'content/backend/onderhoudkorting.php';
});

$router->route('/admin/onderhoud-nieuwsbrief', function(){
    return include 'content/backend/onderhoudnieuwsbrief.php';
});

$router->route('/admin/bestellingoverzicht', function(){
    return include 'content/backend/bestellingoverzicht.php';
});
/**
 *  Execute the route
 */

$action = preg_replace("/\?$/",'',$_SERVER['REQUEST_URI']);
$_SERVER['currentRoute'] = 'test';
$router->dispatch($action);

