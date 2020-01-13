<?php


namespace Model;


class AttachmentStockItem extends Database
{
    private $AttachmentStockItemID;
    private $AttachmentID;
    private $StockitemID;
    private $lastEditedBy;
    function __construct()
    {
        $this->table = "attachmentstockitem";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getAttachmentStockItemID()
    {
        return $this->AttachmentStockItemID;
    }

    /**
     * @param mixed $AttachmentStockItemID
     */
    public function setAttachmentStockItemID($AttachmentStockItemID)
    {
        $this->AttachmentStockItemID = $AttachmentStockItemID;
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
    public function getStockitemID()
    {
        return $this->StockitemID;
    }

    /**
     * @param mixed $StockitemID
     */
    public function setStockItemID($StockitemID)
    {
        $this->StockitemID = $StockitemID;
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

