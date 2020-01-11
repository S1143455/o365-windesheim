<?php


namespace Model;


class Orderline extends Database
{
    private $OrderLineID;
    private $OrderID;
    private $StockItemID;
    private $Description;
    private $PackageTypeID;
    private $Quantity;
    private $UnitPrice;
    private $TaxRate;
    private $PickedQuantity;
    private $PickingCompletedWhen;
    private $LastEditedBy;
    function __construct()
    {
        $this->table = "Orderlines";
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getOrderLineID()
    {
        return $this->OrderLineID;
    }

    /**
     * @param mixed $OrderLineID
     */
    public function setOrderLineID($OrderLineID)
    {
        $this->OrderLineID = $OrderLineID;
    }

    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->OrderID;
    }

    /**
     * @param mixed $OrderID
     */
    public function setOrderID($OrderID)
    {
        $this->OrderID = $OrderID;
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
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getPackageTypeID()
    {
        return $this->PackageTypeID;
    }

    /**
     * @param mixed $PackageTypeID
     */
    public function setPackageTypeID($PackageTypeID)
    {
        $this->PackageTypeID = $PackageTypeID;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @param mixed $Quantity
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
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
    public function getPickedQuantity()
    {
        return $this->PickedQuantity;
    }

    /**
     * @param mixed $PickedQuantity
     */
    public function setPickedQuantity($PickedQuantity)
    {
        $this->PickedQuantity = $PickedQuantity;
    }

    /**
     * @return mixed
     */
    public function getPickingCompletedWhen()
    {
        return $this->PickingCompletedWhen;
    }

    /**
     * @param mixed $PickingCompletedWhen
     */
    public function setPickingCompletedWhen($PickingCompletedWhen)
    {
        $this->PickingCompletedWhen = $PickingCompletedWhen;
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
    public function getLastEditedWhen()
    {
        return $this->LastEditedWhen;
    }

    /**
     * @param mixed $LastEditedWhen
     */
    public function setLastEditedWhen($LastEditedWhen)
    {
        $this->LastEditedWhen = $LastEditedWhen;
    }
    private $LastEditedWhen;


}