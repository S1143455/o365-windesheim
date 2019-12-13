<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$main = new Controller\MainController();
$authentication = new Controller\AuthenticationController();
$discount = new Controller\DiscountController();

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
$categoryController = new Controller\CategoryController();

$user = new Controller\UserController();
$productController = new Controller\ProductController();
$customerController = new Controller\CustomerController();



