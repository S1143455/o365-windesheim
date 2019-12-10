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
            $result .= '<tr>
                        <td class="col-xs-2">' . $category['CategoryID'] .'</td>
                        <td class="col-xs-7">' . $category['CategoryName'] .'</td>
                        <td class="col-xs-3">' . $category['ParentCategory'] .'</td>
                    </tr>';

            echo $result;
        }

    }

}