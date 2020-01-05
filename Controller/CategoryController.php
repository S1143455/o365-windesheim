<?php


namespace Controller;

use Model\Category;
use Model\Database;
use Model\File;
class CategoryController extends FileController
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
            return false;
        };
        $this->category = $category;
        if(isset($_FILES)){
            $attachmentID = $this->upload($this->category->getLastEditedBy());
            var_dump($attachmentID);
            $category->setAttachmentID($attachmentID);
            var_dump($category);

        }

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

    }


    function ParentCategories(){
        $categories = $this->category->getAllActiveCategories();
        foreach($categories as $category){
            if($category->getCategoryName() != ''){
                $result = '<option value="' . $category->getCategoryID()  .'">'. $category->getCategoryName() . '</option>';
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
                            <td class="col-md-1"><button type="submit" name="id" value="' . $category->getCategoryID() .'">Edit</button></td>
                            <td class="col-md-2">' . $category->getCategoryID() .'</td>
                            <td class="col-md-5">' . $category->getCategoryName() .'</td>
                            <td class="col-md-2">' . $category->getParentCategory() .'</td>
                            <td class="col-md-2">iets</td>
                        </tr>';

            echo $result;
        }

    }

}