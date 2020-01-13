<?php

namespace Model;

class Product extends Database
{

    private $StockItemID;
    private $StockItemName;
    private $SupplierID;
    private $Brand;
    private $Barcode;
    private $Size;
    private $LeadTimeDays;
    private $IsChillerStock;
    private $TaxRate;
    private $UnitPrice;
    private $MarketingComments;
    private $CategoryID;
    private $LastEditedBy;
    private $SpecialDealID;
    private $StockItemDescription;
    private $TimesVisited;
    private $recommendedRetailPrice;

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
        return $this->StockItemName;
    }

    /**
     * @param mixed $StockItemName
     */
    public function setStockItemName($StockItemName)
    {
        $this->StockItemName = $StockItemName;
    }

    /**
     * @return mixed
     */
    public function getSupplierID()
    {
        return $this->SupplierID;
    }

    /**
     * @param mixed $SupplierID
     */
    public function setSupplierID($SupplierID)
    {
        $this->SupplierID = $SupplierID;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->Brand;
    }

    /**
     * @param mixed $Brand
     */
    public function setBrand($Brand)
    {
        $this->Brand = $Brand;
    }

    /**
     * @return mixed
     */
    public function getBarcode()
    {
        return $this->Barcode;
    }

    /**
     * @param mixed $Barcode
     */
    public function setBarcode($Barcode)
    {
        $this->Barcode = $Barcode;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->Size;
    }

    /**
     * @param mixed $Size
     */
    public function setSize($Size)
    {
        $this->Size = $Size;
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
        return $this->IsChillerStock;
    }

    /**
     * @param mixed $IsChillerStock
     */
    public function setIsChillerStock($IsChillerStock)
    {
        $this->IsChillerStock = $IsChillerStock;
    }

    /**
     * @return mixed
     */
    public function getTaxRate()
    {
        return $this->TaxRate;
    }

    /**
     * @param mixed $TaxRate
     */
    public function setTaxRate($TaxRate)
    {
        $this->TaxRate = $TaxRate;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->UnitPrice;
    }

    /**
     * @param mixed $UnitPrice
     */
    public function setUnitPrice($UnitPrice)
    {
        $this->UnitPrice = $UnitPrice;
    }

    /**
     * @return mixed
     */
    public function getMarketingComments()
    {
        return $this->MarketingComments;
    }

    /**
     * @param mixed $MarketingComments
     */
    public function setMarketingComments($MarketingComments)
    {
        $this->MarketingComments = $MarketingComments;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->CategoryID;
    }

    /**
     * @param mixed $CategoryID
     */
    public function setCategoryID($CategoryID)
    {
        $this->CategoryID = $CategoryID;
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

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function getTimesVisited()
    {
        return $this->TimesVisited;
    }

    /**
     * @param mixed $TimesVisited
     */
    public function setTimesVisited($TimesVisited)
    {
        $this->TimesVisited = $TimesVisited;
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
}