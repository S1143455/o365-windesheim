<?php


namespace Controller;

use Model\Category;
use Model\Database;

class CategoryController
{
    function __construct()
    {
       $this->category = new category();
    }

    function GetAllCategories()
    {
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            $result = '';
            $result .= '<tr><td>' . $category['CategoryID'] .'</td><td>'. $category['CategoryName'] .'</td></tr>';
            echo $result;
        }

    }

}