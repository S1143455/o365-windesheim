<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});

$main = new Controller\MainController();
$router = new Router\Router();
