<?php


namespace Model;


class File extends Database
{
    private $AttachmentID;
    private $AlternateText;
    private $FileLocation;
    private $LastEditedBy;
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
        return $this->AttachmentID;
    }

    /**
     * @param mixed $AttachmentID
     */
    public function setAttachmentID($AttachmentID)
    {
        $this->AttachmentID = $AttachmentID;
    }

    /**
     * @return mixed
     */
    public function getAlternateText()
    {
        return $this->AlternateText;
    }

    /**
     * @param mixed $AlternateText
     */
    public function setAlternateText($AlternateText)
    {
        $this->AlternateText = $AlternateText;
    }

    /**
     * @return mixed
     */
    public function getFileLocation()
    {
        return $this->FileLocation;
    }

    /**
     * @param mixed $FileLocation
     */
    public function setFileLocation($FileLocation)
    {
        $this->FileLocation = $FileLocation;
    }

    /**
     * @return mixed
     */
    public function getLastEditedBy()
    {
        return $this->LastEditedBy;
    }

    /**
     * @param mixed $LastEditedBy
     */
    public function setLastEditedBy($LastEditedBy)
    {
        $this->LastEditedBy = $LastEditedBy;
    }

}