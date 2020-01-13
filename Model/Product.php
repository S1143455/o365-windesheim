<?php

namespace Model;

class Product extends Database
{

    private $StockItemID;
    private $stockItemName;
    private $supplierID;
    private $brand;
    private $barcode;
    private $size;
    private $LeadTimeDays;
    private $isChillerStock;
    private $taxRate;
    private $unitPrice;
    private $marketingComments;
    private $categoryID;
    private $lastEditedBy;
    private $SpecialDealID;
    private $StockItemDescription;

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
        return $this->StockItemID;
    }

    /**
     * @param mixed $StockItemID
     */
    public function setStockItemID($StockItemID)
    {
        $this->StockItemID = $StockItemID;
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
    public function getLeadTimeDays()
    {
        return $this->LeadTimeDays;
    }

    /**
     * @param mixed $LeadTimeDays
     */
    public function setLeadTimeDays($LeadTimeDays)
    {
        $this->LeadTimeDays = $LeadTimeDays;
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
    public function getStockItemDescription()
    {
        return $this->StockItemDescription;
    }

    /**
     * @param mixed $StockItemDescription
     */
    public function setStockItemDescription($StockItemDescription)
    {
        $this->StockItemDescription = $StockItemDescription;
    }
}