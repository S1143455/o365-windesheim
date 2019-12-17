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
    public function retrieve($id){
        $category = new category();
        $category = $category->retrieve($id);
        if(empty($category->getCategoryID()))
        {
            header("Location: /404", true);
        }

        return $category;
    }
    public function create()
    {
        print_r($_POST);
        $this->category = new category();
        $this->category->initialize();
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
           // print_r($_GET);
            return false;
        };

        $this->category = $category;

        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $category Category
     * @return string
     */
    public function update($category)
    {


//        if (!$category->initialize())
//        {
//            // print_r($_GET);
//            return false;
//        };
//
//        $this->category = $category;
//
//        if (!$this->category->save())
//        {
//            return "Something went wrong.";
//        }
    }


    function ParentCategories(){
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            if($category['CategoryName'] != ''){
                $result = '<option value="' . $category['CategoryID'] .'">'. $category['CategoryName'] . '</option>';
                echo $result;
            }
        }
    }

    function GetAllCategories()
    {
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="button" class="open-EditDialog" style="color: #428bca;" data-toggle="modal" id="open-EditDialog" data-id="' . $category['CategoryID'] .'"  data-target="#EditCategorieDialog">Edit</button></td>
                            <td class="col-md-2">' . $category['CategoryID'] .'</td>
                            <td class="col-md-5">' . $category['CategoryName'] .'</td>
                            <td class="col-md-2">' . $category['ParentCategory'] .'</td>
                            <td class="col-md-2">iets</td>
                        </tr>';

            echo $result;
        }

    }

}