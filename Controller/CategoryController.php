<?php


namespace Controller;

use Model\Category;
use Model\Database;
use Model\Product;

class CategoryController
{
    private $admin = 'content/backend/';

    function __construct()
    {
       $this->category = new category();
    }
    public function create()
    {
        print_r($_POST);
        $this->category = new category();
        $this->category->initialize();

        //$this->category->setCategoryID();
        $this->category->setLastEditedBy(2);
        $this->store($this->category);

       // return "true";
       // include $this->contentpath
        include $this->admin . 'onderhoudc.php';
    }
    /**
     * Stores the product in the database.
     *
     * @param $category Category
     * @return string
     */
    public function store($category)
    {
        if (!$category->initialize())
        {
            print_r($_GET);
            return false;
        };

        $this->category = $category;

        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
    }

    function GetAllCategories()
    {
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-xs-2">' . $category['CategoryID'] .'</td>
                            <td class="col-xs-7">' . $category['CategoryName'] .'</td>
                            <td class="col-xs-3">' . $category['ParentCategory'] .'</td>
                        </tr>';

            echo $result;
        }

    }

}