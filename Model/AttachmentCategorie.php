<?php


namespace Model;


class AttachmentCategorie extends Database
{
    private $AttachmentCategorieID;
    private $attachmentID;
    private $categoryID;
    private $lastEditedBy;

    function __construct()
    {
        $this->table = "attachmentcategorie";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getAttachmentCategorieID()
    {
        return $this->AttachmentCategorieID;
    }

    /**
     * @param mixed $AttachmentCategorieID
     */
    public function setAttachmentCategorieID($AttachmentCategorieID)
    {
        $this->AttachmentCategorieID = $AttachmentCategorieID;
    }

    /**
     * @return mixed
     */
    public function getAttachmentID()
    {
        return $this->attachmentID;
    }

    /**
     * @param mixed $attachmentID
     */
    public function setAttachmentID($attachmentID)
    {
        $this->attachmentID = $attachmentID;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param mixed $categoryID
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }

    /**
     * @return mixed
     */
    public function getLastEditedBy()
    {
        return $this->lastEditedBy;
    }

    /**
     * @param mixed $lastEditedBy
     */
    public function setLastEditedBy($lastEditedBy)
    {
        $this->lastEditedBy = $lastEditedBy;
    }


}
