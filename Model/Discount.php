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
}


