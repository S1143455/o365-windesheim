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
                        <td class="col-xs-3">' . $category['CategoryID'] .'</td>
                        <td class="col-xs-3"></td>
                        <td class="col-xs-6">johndoe@email.com</td>
                    </tr>';

            echo $result;
        }

    }

}