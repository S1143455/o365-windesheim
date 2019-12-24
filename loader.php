<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$main = new Controller\MainController();
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

$orderController = new Controller\OrderController();

$discountController = new Controller\DiscountController();

$user = new Controller\UserController();
$productController = new Controller\ProductController();


$customerController = new Controller\CustomerController();


if (isset($_SESSION['authenticated']))
{
    echo '<div class="container" style="width:100%">
    <div class="row">';
        include_once 'content/frontend/sidebar.php';
    echo '</div>
</div>';
}


