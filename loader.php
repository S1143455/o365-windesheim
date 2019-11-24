<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});
$database = new Classes\Database();
$authentication = new Classes\Authentication($database);
$user = new Classes\User;