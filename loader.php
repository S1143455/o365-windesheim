<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$main = new Controller\MainController();
$authentication = new Controller\AuthenticationController();
switch ($authentication->role()){
    case 'admin' :
        break;
    case 'customer':
        break;
    case 'supplier':
        break;
    default:
        break;
}
$admin = new Controller\AdminController();
$user = new Controller\UserController();
$productController = new Controller\ProductController();




