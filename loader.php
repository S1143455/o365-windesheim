<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});

$router = new Router\Router();
$mainController = new Controller\MainController();
$authenticationController = new Controller\AuthenticationController();
$discount = new Controller\DiscountController();
$admin = new Controller\AdminController();
$discountController = new Controller\DiscountController();
$user = new Controller\UserController();
$productController = new Controller\ProductController();
$customer = new Controller\CustomerController();
$userController = new Controller\UserController();
$categoryController = new Controller\CategoryController();
$orderController = new Controller\OrderController();
$orderLineController = new Controller\OrderlineController();
$customerController = new Controller\CustomerController();
$shoppingcartStockitems= new Controller\ShoppingcartStockitemsController();

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


if (isset($_SESSION['authenticated']) && !isset($_SESSION['authenticatedAdmin']))
{
    echo '<div class="container" style="width:100%">
            <div class="row">';
    include_once 'content/frontend/sidebar.php';
    echo '</div> </div>';
}



