<?php


namespace Controller;
use Model\Attachments;

class FileController
{
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