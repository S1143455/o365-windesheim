<?php
// Comment these lines to hide errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Initialize composer autoloader;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();


//Initialize our Controller
require_once 'loader.php';

$database = new Model\Database();
$authentication = new Controller\Authentication($database);
$user = new Controller\User($database);
$productController = new Controller\ProductController();

include_once 'Router/Routes.php';
