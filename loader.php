<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});

$main = new Controller\Main();
$router = new Router\Router();
