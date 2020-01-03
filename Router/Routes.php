<?php
/**
 * ALL Routes the website uses will be defined here.
*/

$router->route('/', function() use ($mainController){
    //return include 'content/frontend/home.php';
    return $mainController->index();
});

$router->route('/about', function(){
    return 'hello, world';
});

$router->route('/about-us', function(){
    return include 'content/frontend/about-us.php';
});

/**
 * Passwordrecovery
 */

$router->route('/passwordrecovery', function() use($userController){
    return include 'content/frontend/passwordrecovery.php';
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

$router->route('/onderhoudbestellingen', function(){
    return include 'content/frontend/usermaintenance.php';
});

$router->route('/accountverwijderen', function(){
    return include 'content/frontend/DeleteUserAccount.php';
});

/**
 * End usermaintenance
 */

/**
 * Begin shoppingcart items
 */
$router->route('/winkelwagen', function(){
    return include 'content/frontend/shoppingcart/shoppingcart.php';
});

$router->route('/afrekenen', function(){
    return include 'content/frontend/shoppingcart/paycart.php';
});

$router->route('/betalengelukt', function(){
    return include 'content/frontend/shoppingcart/paymentsuccess.php';
});

$router->route('/betalenmislukt', function(){
    return include 'content/frontend/shoppingcart/paymentfailed.php';
});
/**
 * End of shoppingcart items
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

$router->route('/admin', function(){
    return include 'content/backend/home-admin.php';
});

$router->route('/admin/passwordrecovery', function() use($userController){
    return include 'content/backend/passwordrecovery.php';
});

$router->route('/admin/login', function(){
    return include 'views/login-Admin/login.php';
});

$router->route('/admin/logout', function(){
    return include 'views/login-Admin/logout.php';
});



$router->route('/admin/onderhoud', function(){
    return include 'content/backend/onderhoud-admin.php';
});

$router->route('/admin/onderhoud-hoofdpagina', function(){
    return include 'content/backend/onderhoudhoofdpagina.php';
});


$router->route('/admin/onderhoud-categorieen', function(){
    return include 'content/backend/onderhoudc.php';
});

$router->route('/admin/onderhoud-producten', function() use($productController){
    return $productController->admin();
});

$router->route('/admin/onderhoud-klanten', function(){
    return include 'content/backend/onderhoudklanten.php';
});
$router->route('/admin/CreateCategorie', function() use($categoryController){
    return $categoryController->create();
});
$router->route('/admin/CreateDiscount', function() use($discountController){
    return $discountController->create();
});
$router->route('/admin/UpdateDiscount', function() use($discountController){
    return $discountController->update();
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
$router->route('/admin/bestellingoverzicht', function(){
    return include 'content/backend/bestellingoverzicht.php';
});
$router->route('/admin/upload', function(){
    return include 'content/backend/upload.php';
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

