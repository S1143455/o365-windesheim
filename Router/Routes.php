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
 * Login route
 */

$router->route('/login', function(){
    return include 'views/login/login.php';
});

$router->route('/logout', function(){
    return include 'views/login/logout.php';
});

/**
 * Begin usermainteance
 */
$router->route('/onderhoudaccount', function(){
    return include 'content/frontend/usermaintenance.php';
});

/**
 * End usermaintenance
 */

/**
 * Begin product routes
 */
$router->route('/product', function() use($productController){
    return $productController->index();
});
$router->route('/product/create', function() use($productController){
    return $productController->create();
});

$router->route('/product/{id}', function($id) use($productController){
    return $productController->show($id);
});

/**
 * End product routes
 */

/**
 * Begin admin routes
 */
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
$router->route('/admin/test', function() use($categoryController){
    return $categoryController->create();
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
$router->route('/admin/Onderhoud-hoofdpagina', function(){
    return include 'content/backend/onderhoudhoofdpagina.php';
});
/**
 * End AdminController routes
 */


$router->route("/404", function()
{
    return include 'content/404.php';
});

/**
 *  Execute the route
 */

$action = preg_replace("/\?$/",'',$_SERVER['REQUEST_URI']);
$router->dispatch($action);

