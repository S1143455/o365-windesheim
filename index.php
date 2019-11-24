<?php

// Comment these lines to hide errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Initialize composer autoloader;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();


//Initialize our classes
require_once 'loader.php';


//$router->route('/', function(){
//    include 'content/home.php';
//});
//
//$router->route('/about', function(){
//    return 'hello, world';
//});
//
//$action = $_SERVER['REQUEST_URI'];
//$router->dispatch($action);


$main->init();