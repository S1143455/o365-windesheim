<?php


namespace Controller;
use Model\Attachments;
use Model\AttachmentCategorie;
Use Model\AttachmentStockItem;
class FileController
{
    private $admin = 'content/backend/';

    function __construct()
    {
        $this->attachment = new Attachments();
        $this->attachmentCategorie = new AttachmentCategorie();
        $this->attachmentStockItem = new AttachmentStockItem();
    }
    function getAllAttachments($attachments)
    {
        foreach ($attachments as $attachment){
            $categories = $this->retrieveWhereCategory($attachment->getAttachmentID());
            $stockitems = $this->retrieveWhereStockitem($attachment->getAttachmentID());
            $result = '';
            $result .= '<tr>
                    <td class="col-md-2"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $attachment->getAttachmentID() .'">Edit</button></td>
                    <td class="col-md-3">' . $attachment->getAlternateText() . '</td>                 
                    <td class="col-md-3">' . $attachment->getFileLocation() .'</td>';
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
    public function create()
    {
        if(!empty($_FILES)){
            if(isset($_FILES) && $_FILES['fileToUpload'] != null && $_FILES["fileToUpload"]["tmp_name"] != null){
                $attachmentID = $this->upload($_SESSION['personID']);
                $this->attachment =  $this->retrieve($attachmentID);
                if (isset($_POST["selectedProductIDs"])) {
                    foreach ($_POST["selectedProductIDs"] as $id) {
                        $this->attachmentStockItem = new AttachmentStockItem();
                        $this->attachmentStockItem->setAttachmentID($this->attachment->getAttachmentID());
                        $this->attachmentStockItem->setStockItemID($id);
                        $this->attachmentStockItem->setLastEditedBy($_SESSION['personID']);
                        var_dump($this->attachment->getAttachmentID());

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
                $this->attachment->setLastEditedBy($_SESSION['personID']);
                $this->attachment->setAlternateText($_POST["alternateText"]);
                $this->store($this->attachment);
            }
        }
        include $this->admin . 'onderhoudMedia.php';
        return "";

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
            $attachment->save();
            return $attachment->getAttachmentID();
        }

}