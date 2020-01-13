<?php


namespace Controller;
use Model\Attachments;
use Model\AttachmentCategorie;
Use Model\AttachmentStockItem;
use Model\Product;

class FileController
{
    private $admin = 'content/backend/';

    function __construct()
    {
        $this->productFile = new Product();
        $this->attachment = new Attachments();
        $this->attachmentCategorie = new AttachmentCategorie();
        $this->attachmentStockItem = new AttachmentStockItem();
    }
    function UpdateVisited($productid){
        $product = $this->retrieveProduct($productid);
        $product->setTimesVisited($product->getTimesVisited() + 1);
        $this->storeProduct($product);
        return $product;
    }
    function getAllAttachments($attachments)
    {
        foreach ($attachments as $attachment){
            $categories = $this->retrieveWhereCategory($attachment->getAttachmentID());
            $stockitems = $this->retrieveWhereStockitem($attachment->getAttachmentID());
            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $attachment->getAttachmentID() .'">Edit</button></td>
                    <td class="col-md-1">' . $attachment->getAlternateText() . '</td> ';
            if($attachment->getActive() == 1 ){
                $result .=  "<td class='col-md-1'>on</td>";
            }else{
                $result .=  "<td class='col-md-1'>off</td>";
            }
            $result.= '
                    <td class="col-md-3">' . $attachment->getFileLocation() .'</td>
                    <td class="col-md-2">' . $attachment->getURL() .'</td>';

            if($categories[0]->getAttachmentID() != null){
                $result .=  "<td class='col-md-2'>" . count($categories) ."</td>";
            }else{
                $result .=  "<td class='col-md-2'>0</td>";
            }
            if($stockitems[0]->getAttachmentID() != null){
                $result .=  "<td class='col-md-2'>" . count($stockitems) ."</td>";
            }else{
                $result .=  "<td class='col-md-2'>0</td>";
            }
            $result .= "</tr>";


                 
               
            echo $result;
        }

    }
    /**
     * Stores the product in the database.
     *
     * @param $productID int
     * @return $product Product
     */
    public function retrieveProduct($productID){
        $product = new Product();
        $product = $product->retrieve($productID);
        if(empty($product->getStockItemID()))
        {
            //header("Location: /404", true);
        }

        return $product;
    }

    public function retrieve($id){
        $attachment = new Attachments();
        $attachment = $attachment->retrieve($id);
        if(empty($attachment->getAttachmentID()))
        {
            //header("Location: /404", true);
        }

        return $attachment;
    }
    public function retrieveAll(){
        $attachments = new Attachments();
        $attachments = $attachments->retrieve();
        if(empty($attachments))
        {
            //header("Location: /404", true);
        }

        return $attachments;
    }
    public function retrieveWhereStockitem($attachmentID){
        $AttachmentStockItems = $this->attachmentStockItem->where("*", "attachmentID", "=", $attachmentID);
        return $AttachmentStockItems;
    }
    public function retrieveWhereCategory($attachmentID){
        $AttachmentCategorys = $this->attachmentCategorie->where("*", "attachmentID", "=", $attachmentID);
        return $AttachmentCategorys;
    }
    public function retrieveWhereStockitemBackwards($productID){
        $AttachmentStockItems = $this->attachmentStockItem->where("*", "StockItemID", "=", $productID);
        return $AttachmentStockItems;
    }
    public function retrieveWhereCategoryBackWards($categorieID){
        $AttachmentCategorys = $this->attachmentCategorie->where("*", "categoryID", "=", $categorieID);
        return $AttachmentCategorys;
    }
    public function retrieveWhereAttachmentID($attachmentID){
        $Attachment = $this->attachment->where("*", "AttachmentID", "=", $attachmentID);
        return $Attachment[0];
    }
    public function create()
    {
        if(!empty($_FILES)) {
            if (isset($_FILES) && $_FILES['fileToUpload'] != null && $_FILES["fileToUpload"]["tmp_name"] != null) {
                $attachmentID = $this->upload($_SESSION['personID']);
                $this->attachment = $this->retrieve($attachmentID);
            }

        }else if(!empty($_POST['URL'])){

            $this->attachment = new Attachments();
            $this->attachment->setURL($_POST['URL']);
        }
        $this->attachment->setLastEditedBy($_SESSION['personID']);
        if(isset($_POST["alternateText"])){
            $this->attachment->setAlternateText($_POST["alternateText"]);
        }
        if(isset($_POST["ACTIVE"])){
            $this->attachment->setActive($_POST['ACTIVE']);
        }
        $this->store($this->attachment);
        if (isset($_POST["selectedProductIDs"])) {
            foreach ($_POST["selectedProductIDs"] as $id) {
                $this->attachmentStockItem = new AttachmentStockItem();
                $this->attachmentStockItem->setAttachmentID($this->attachment->getAttachmentID());
                $this->attachmentStockItem->setStockItemID($id);
                $this->attachmentStockItem->setLastEditedBy($_SESSION['personID']);
                //var_dump($this->attachment->getAttachmentID());

                $this->storeStock($this->attachmentStockItem);
            }
        }
        if (isset($_POST["selectedCategoryIDs"])) {
            foreach ($_POST["selectedCategoryIDs"] as $id) {
                $this->attachmentCategorie = new attachmentCategorie();
                $this->attachmentCategorie->setAttachmentID($this->attachment->getAttachmentID());
                $this->attachmentCategorie->setCategoryID($id);
                $this->attachmentCategorie->setLastEditedBy($_SESSION['personID']);
                $this->storeCategory($this->attachmentCategorie);
            }
        }
        //var_dump($_POST);



        include $this->admin . 'onderhoudMedia.php';
        return "";

    }

    /**
     * Stores the product in the database.
     *
     * @param $product Product
     * @return string
     */
    public function storeProduct($product)
    {
        if (!$product->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->productFile = $product;
        if (!$this->productFile->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $attachment Attachments
     * @return string
     */
    public function store($attachment)
    {
        if (!$attachment->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->attachment = $attachment;

        if (!$this->attachment->save())
        {
            return "Something went wrong.";
        }
    }
    /**
     * Stores the product in the database.
     *
     * @param $attachment Attachments
     * @return Attachments
     */
    public function storeAttachment($attachment)
    {
        if (!$attachment->initialize()) {};
        $this->attachment = $attachment;
        if (!$this->attachment->save()) {}
        return $this->attachment;
    }

    /**
     * Stores the product in the database.
     *
     * @param $attachmentStockItem AttachmentStockItem
     * @return string
     */
    public function storeStock($attachmentStockItem)
    {
        if (!$attachmentStockItem->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->attachmentStockItem = $attachmentStockItem;

        if (!$this->attachmentStockItem->save())
        {
            return "Something went wrong.";
        }
    }
    /**
     * Stores the product in the database.
     *
     * @param $attachmentCategory AttachmentCategorie
     * @return string
     */
    public function storeCategory($attachmentCategory)
    {
        if (!$attachmentCategory->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->attachmentCategorie = $attachmentCategory;

        if (!$this->attachmentCategorie->save())
        {
            return "Something went wrong.";
        }
    }
    public function uploadMultiple($count, $lastEditedBy){
        $attachments = [];
        for ($i = 0; $i < $count; $i++) {
            $out = '';
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["attachmentIMG"]["name"][$i]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(isset($_POST["submit"])) {
                if($_FILES != null){
                    $check = getimagesize($_FILES["attachmentIMG"]["tmp_name"][$i]);
                    if($check !== false) {
                        $out .= "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $out .= "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)) {
                    $out .= "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                if ($_FILES["attachmentIMG"]["size"][$i] > 500000) {
                    $out .= "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $out .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    $out .= "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["attachmentIMG"]["tmp_name"][$i], $target_file)) {
                        $out .= "The file ". basename( $_FILES["attachmentIMG"]["name"][$i]). " has been uploaded.";
                    } else {
                        $out .= "Sorry, there was an error uploading your file.";
                    }
                }
            }

            $attachment = new Attachments();
            $attachment->setLastEditedBy($lastEditedBy);
            $attachment->setAlternateText(basename( $_FILES["attachmentIMG"]["name"][$i]));
            $attachment->setFileLocation($target_file);
            $attachment->setActive(1);
            $attachment->save();
            array_push($attachments, $attachment);
        }

        return $attachments;
    }
    public function upload($lastEditedBy){
            $out = '';
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(isset($_POST["submit"])) {
                if($_FILES != null){
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $out .= "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $out .= "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)) {
                    $out .= "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    $out .= "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $out .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    $out .= "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $out .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    } else {
                        $out .= "Sorry, there was an error uploading your file.";
                    }
                }
            }

            $attachment = new Attachments();
            $attachment->setLastEditedBy($lastEditedBy);
            $attachment->setAlternateText(basename( $_FILES["fileToUpload"]["name"]));
            $attachment->setFileLocation($target_file);
            $attachment->setActive(1);
            $attachment->save();
            return $attachment->getAttachmentID();
        }

}