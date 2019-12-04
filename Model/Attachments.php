<?php


namespace Model;


class Attachments extends Database
{
    private $attachmentID;
    private $alternateText;
    private $fileLocation;
    private $lastEditedBy;
    private $stockItemId;
    private $categoryID;

    /**
     * @return mixed
     */
    function getAttachmentID()
    {
        return $this->attachmentID;
    }

    /**
     * @param $attachmentID
     */
    function setAttachmentID($attachmentID)
    {
        $this->attachmentID = $attachmentID;
    }

    /**
     * @return mixed
     */
    function getAlternateText()
    {
        return $this->alternateText;
    }

    /**
     * @param $AlternateText
     */
    function setAlternateText($AlternateText)
    {
        $this->alternateText = $AlternateText;
    }

    /**
     * @return mixed
     */
    function getFileLocation()
    {
        return $this->FileLocation;
    }

    /**
     * @param $FileLocation
     */
    function setFileLocation($FileLocation)
    {
        $this->fileLocation = $FileLocation;
    }

    /**
     * @return mixed
     */
    function getLastEditedBy()
    {
        return $this->LastEditedBy;
    }

    /**
     * @param $LastEditedBy
     */
    function setLastEditedBy($LastEditedBy)
    {
        $this->lastEditedBy = $LastEditedBy;
    }

    /**
     * @return mixed
     */
    function getStockItemId()
    {
        return $this->stockItemId;
    }

    /**
     * @param $stockItemId
     */
    function setStockItemId($stockItemId)
    {
        $this->stockItemId = $stockItemId;
    }

    /**
     * @return mixed
     */
    function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param $categoryID
     */
    function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }
}