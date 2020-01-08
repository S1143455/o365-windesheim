<?php


spl_autoload_register(function ($class) {
    include $class . '.php';
});
$router = new Router\Router();
$mainController = new Controller\MainController();
<<<<<<< HEAD
$authenticationController = new Controller\AuthenticationController();
$discount = new Controller\DiscountController();
$customer = new Controller\CustomerController();
=======
//$authenticationController = new Controller\AuthenticationController();
//$discount = new Controller\DiscountController();
//$customer = new Controller\CustomerController();
>>>>>>> 30e993e85d6bf3250c551600a75f0c7332055670
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

$discountController = new Controller\DiscountController();
//$user = new Controller\UserController();
$customerController = new Controller\CustomerController();
//$user = new Controller\UserController();
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


