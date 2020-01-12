<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$mainController = new Controller\MainController();
$authenticationController = new Controller\AuthenticationController();
$discount = new Controller\DiscountController();
$customer = new Controller\CustomerController();
//$authenticationController = new Controller\AuthenticationController();
//$discount = new Controller\DiscountController();
//$customer = new Controller\CustomerController();
$authenticationController = new Controller\AuthenticationController();
$userController = new Controller\UserController();

switch ($userController->role()){
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
$orderController = new Controller\OrderController();
$orderLineController = new Controller\OrderlineController();

$discountController = new Controller\DiscountController();
$customerController = new Controller\CustomerController();
$adressController = new Controller\AdressController();

$productController = new Controller\ProductController();
$shoppingcartStockitems= new Controller\ShoppingcartStockitemsController();
$customerController = new Controller\CustomerController();

if (isset($_SESSION['authenticated']) && !isset($_SESSION['authenticatedAdmin']))
{
//    echo '<div class="container-fluid">
//            <div class="row">';
//    include_once 'content/frontend/sidebar.php';
//    echo '</div> </div>';
}



