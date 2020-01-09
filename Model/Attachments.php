<?php

namespace Model;

class Attachments extends Database
{
    private $attachmentID;
    private $alternateText;
    private $fileLocation;
    private $lastEditedBy;

    function __construct()
    {
        $this->table = "attachments";
        parent::__construct();

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
    public function getAlternateText()
    {
        return $this->alternateText;
    }

    /**
     * @param mixed $alternateText
     */
    public function setAlternateText($alternateText)
    {
        $this->alternateText = $alternateText;
    }

    /**
     * @return mixed
     */
    public function getFileLocation()
    {
        return $this->fileLocation;
    }

    /**
     * @param mixed $fileLocation
     */
    public function setFileLocation($fileLocation)
    {
        $this->fileLocation = $fileLocation;
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