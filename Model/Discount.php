<?php


namespace Model;


class Discount extends Database
{
    private $SpecialDealID;
    private $DealDescription;
    private $StartDate;
    private $EndDate;
    private $DiscountPercentage;
    private $DealCode;
    private $LastEditedBy;
    private $OneTime;

    /**
     * @return mixed
     */
    public function getOneTime()
    {
        return $this->OneTime;
    }

    /**
     * @param mixed $OneTime
     */
    public function setOneTime($OneTime)
    {
        $this->OneTime = $OneTime;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->Active;
    }

    /**
     * @param mixed $Active
     */
    public function setActive($Active)
    {
        $this->Active = $Active;
    }
    private $Active;

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
    public function getDealDescription()
    {
        return $this->DealDescription;
    }

    /**
     * @param mixed $DealDescription
     */
    public function setDealDescription($DealDescription)
    {
        $this->DealDescription = $DealDescription;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param mixed $StartDate
     */
    public function setStartDate($StartDate)
    {
        $this->StartDate = $StartDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->EndDate;
    }

    /**
     * @param mixed $EndDate
     */
    public function setEndDate($EndDate)
    {
        $this->EndDate = $EndDate;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercentage()
    {
        return $this->DiscountPercentage;
    }

    /**
     * @param mixed $DiscountPercentage
     */
    public function setDiscountPercentage($DiscountPercentage)
    {
        $this->DiscountPercentage = $DiscountPercentage;
    }

    /**
     * @return mixed
     */
    public function getDealCode()
    {
        return $this->DealCode;
    }

    /**
     * @param mixed $DealCode
     */
    public function setDealCode($DealCode)
    {
        $this->DealCode = $DealCode;
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

    public function getAllSpecialDeals(){
        $result = '';
        $result = $this->select('SELECT * FROM schoolproject.specialdeals;');
        return $result;
    }

    public function getProductBasedOnID($ID){

        $result = $this->select('SELECT COUNT(StockItemId) as total FROM stockitem WHERE DealID = '.$ID.';');

        return $result[0]['total'];
    }
}


