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
            //header("Location: /404", true);
        }

        return $category;
    }
    public function create()
    {
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
        var_dump($_POST);

        if(isset($_FILES)){
            $test = $category->upload();
            var_dump($test);
//            $target_dir = "uploads/";
//            $target_file = $target_dir . basename($_POST["fileToUpload"]["name"]);
//            $uploadOk = 1;
//            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//            $check = getimagesize($_POST["fileToUpload"]["tmp_name"]);
//            if($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
//                $uploadOk = 1;
//            } else {
//                echo "File is not an image.";
//                $uploadOk = 0;
//            }

        }
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

    /**
     * Stores the product in the database.
     *
     * @param $category $category1
     * @return string
     */
    public function update($category1)
    {
        $this->store($category1);

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
        //<button type="button" class="open-EditDialog" style="color: #428bca;" data-toggle="modal" id="open-EditDialog" data-id=""  data-target="#EditCategorieDialog">Edit</button>
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            $result = '';
            $result .= '<tr style="height:40px;">
                            <td class="col-md-1"><button type="submit" name="id" value="' . $category['CategoryID'] .'">Edit</button></td>
                            <td class="col-md-2">' . $category['CategoryID'] .'</td>
                            <td class="col-md-5">' . $category['CategoryName'] .'</td>
                            <td class="col-md-2">' . $category['ParentCategory'] .'</td>
                            <td class="col-md-2">iets</td>
                        </tr>';

            echo $result;
        }

    }

}