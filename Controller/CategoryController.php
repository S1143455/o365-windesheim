<?php


namespace Controller;

use Model\AttachmentCategorie;
use Model\Category;
use Model\Database;
use Model\Attachments;
use Model\Discount;

class CategoryController extends FileController
{
    private $admin = 'content/backend/';

    function __construct()
    {
        $this->discount = new Discount();

        $this->category = new category();
    }
    public function retrieveCategory($id){
        $category = new category();
        $category = $category->retrieve($id);
        if(empty($category->getCategoryID()))
        {
            //header("Location: /404", true);
        }

        return $category;
    }
    public function retrieveAttachment($id){
        $attachment = new Attachments();
        $attachment = $attachment->retrieve($id);
        if(empty($attachment->getAttachmentID()))
        {
            //header("Location: /404", true);
        }
        return $attachment;
    }

    public function getParentCategoryfromCategory($category){
        if($category->getParentCategory() != null){
            return $this->retrieveCategory($category->getParentCategory());
        }else {
            return null;
        }
    }


//    public function getAttachmentfromCategory($category){
//        if($category->getAttachmentID() != null){
//            return $this->retrieveCategory($category->getAttachmentID());
//        }else {
//            return null;
//        }
//    }
    public function create()
    {
        $this->category = new category();
        $this->category->initialize();
        $this->category->setLastEditedBy(2);
        $this->store($this->category);

        header("Location: /".  getenv('ROOTAdmin') ."/onderhoud-categorieen");
    }
    public function GetAllDiscountsForcategorie()
    {
        $specialdeals = $this->discount->retrieve();

        foreach ($specialdeals as $specialdeal) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedProductIDs[]" id="selectTableRow" value="'. $specialdeal->getSpecialDealID().'"></td>
                   <td class="col-md-4">' . $specialdeal->getDealDescription() . '</td>
                   <td class="col-md-2">' . $specialdeal->getDiscountPercentage() . '</td>
                   <td class="col-md-4">' . $specialdeal->getActive() . '</td>
                </tr>';
            echo $result;
        }
    }
    public function GetAllDiscountsForActiveCategorie($categorie)
    {
        $specialdealActive = $this->discount->retrieve($categorie->getSpecialDealID());
        $specialdeals = $this->discount->retrieve();

        foreach ($specialdeals as $specialdeal) {
            $result = '';
            $result .= '<tr>';
            if($specialdeal->getSpecialDealID() == $specialdealActive->getSpecialDealID()){
                $result .= '<td class="col-md-2"><input class="selectTableRow" checked type="checkbox" name="selectedProductIDs[]" id="selectTableRow" value="'. $specialdeal->getSpecialDealID().'"></td>';
            }else{
                $result .= '<td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedProductIDs[]" id="selectTableRow" value="'. $specialdeal->getSpecialDealID().'"></td>';
            }
            $result .= '<td class="col-md-4">' . $specialdeal->getDealDescription() . '</td>
                   <td class="col-md-2">' . $specialdeal->getDiscountPercentage() . '</td>
                   <td class="col-md-4">' . $specialdeal->getActive() . '</td>
                </tr>';
        }
         echo $result;

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
        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
        if (isset($_FILES) && $_FILES['attachmentIMG'] != null && $_FILES["attachmentIMG"]["tmp_name"][0] != null) {
            $attachments = $this->uploadMultiple(count($_FILES["attachmentIMG"]["name"]), $_SESSION['personID']);
            foreach($attachments as $attachment){
                $AttachmentCategorie = new AttachmentCategorie();
                $AttachmentCategorie->setAttachmentID($attachment->getAttachmentID());
                $AttachmentCategorie->setCategoryID($this->category->getCategoryID());
                $AttachmentCategorie->setLastEditedBy($_SESSION['personID']);
                $this->storeCategory($AttachmentCategorie);
            }
        }
//        if(isset($_FILES) && $_FILES['fileToUpload'] != null && $_FILES["fileToUpload"]["tmp_name"] != null){
//            $attachmentID = $this->upload($this->category->getLastEditedBy());
//            $category->setAttachmentID($attachmentID);
//        }else{
//            $category->setAttachmentID(null);
//        }


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
                            <td style="min-height: 50px;" class="col-md-2"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $category->getCategoryID() .'">Edit</button></td>
                            <td style="min-height: 50px;" class="col-md-2">' . $category->getCategoryID() .'</td>
                            <td style="min-height: 50px;" class="col-md-5">' . $category->getCategoryName() .'</td>
                            <td style="min-height: 50px;" class="col-md-3">' . $category->getParentCategory() .'</td>
                        </tr>';

            echo $result;
        }

    }

}