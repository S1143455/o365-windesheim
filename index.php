<?php

// Comment these lines to hide errors
error_reporting(E_ALL);
ini_set('display_errors', 1);


//Initialize composer autoloader;
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();


//Initialize our classes
require_once 'loader.php';


require 'includes/config.php';
require 'includes/functions.php';






init();