<?php


use Model\Category;

if (isset($_POST['submit'])) {
    include 'loader.php';
    $category = new Category();
    $category->initialize();
    $categoryController->store($category);
    die();
}
