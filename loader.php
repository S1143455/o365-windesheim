<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$mainController = new Controller\MainController();
$authenticationController = new Controller\AuthenticationController();
$discount = new Controller\DiscountController();

switch ($authenticationController->role()){
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

$discountController = new Controller\DiscountController();
$userController = new Controller\UserController();
//$user = new Controller\UserController();
$productController = new Controller\ProductController();





