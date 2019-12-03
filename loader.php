<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});
$router = new Router\Router();
$main = new Controller\MainController();
$authentication = new Controller\AuthenticationController();
$user = new Controller\UserController();
$productController = new Controller\ProductController();
