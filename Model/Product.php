<?php

namespace Model;

class Product extends Database
{

    private $stockItemID;
    private $stockItemName;
    private $supplierID;
    private $brand;
    private $barcode;
    private $size;
    private $loadTimeDays;
    private $isChillerStock;
    private $taxRate;
    private $unitPrice;
    private $marketingComments;
    private $categoryID;
    private $attachmentID;
    private $lastEditedBy;
    private $recommendedRetailPrice;
    private $SpecialDealID;

    function __construct()
    {
        $this->table = "stockitem";
        parent::__construct();

    }

    /**
     * @return mixed
     */
    public function getStockItemID()
    {
        return $this->stockItemID;
    }

    /**
     * @param mixed $stockItemID
     */
    public function setStockItemID($stockItemID)
    {
        $this->stockItemID = $stockItemID;
    }

    /**
     * @return mixed
     */
    public function getStockItemName()
    {
        return $this->stockItemName;
    }

    /**
     * @param mixed $stockItemName
     */
    public function setStockItemName($stockItemName)
    {
        $this->stockItemName = $stockItemName;
    }

    /**
     * @return mixed
     */
    public function getSupplierID()
    {
        return $this->supplierID;
    }

    /**
     * @param mixed $supplierID
     */
    public function setSupplierID($supplierID)
    {
        $this->supplierID = $supplierID;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param mixed $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }
    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getLoadTimeDays()
    {
        return $this->loadTimeDays;
    }

    /**
     * @param mixed $loadTimeDays
     */
    public function setLoadTimeDays($loadTimeDays)
    {
        $this->loadTimeDays = $loadTimeDays;
    }

    /**
     * @return mixed
     */
    public function getIsChillerStock()
    {
        return $this->isChillerStock;
    }

    /**
     * @param mixed $isChillerStock
     */
    public function setIsChillerStock($isChillerStock)
    {
        $this->isChillerStock = $isChillerStock;
    }

    /**
     * @return mixed
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param mixed $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getMarketingComments()
    {
        return $this->marketingComments;
    }

    /**
     * @param mixed $marketingComments
     */
    public function setMarketingComments($marketingComments)
    {
        $this->marketingComments = $marketingComments;
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

    /**
     * @return mixed
     */
    public function getRecommendedRetailPrice()
    {
        return $this->recommendedRetailPrice;
    }

    /**
     * @param mixed $recommendedRetailPrice
     */
    public function setRecommendedRetailPrice($recommendedRetailPrice)
    {
        $this->recommendedRetailPrice = $recommendedRetailPrice;
    }

    public function getSpecialDealID()
    {
        return $this->SpecialDealID;
    }

    /**
     * @param mixed $SpecialDealID
     */

    public function setSpecialDealID($SpecialDealID)
    {
        $this->SpecialDealID = $SpecialDealID;
    }

    /**
     * @return mixed
     */
}