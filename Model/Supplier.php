<?php


namespace Model;

class Supplier extends User
{
    private $SupplierID;
    private $SupplierName;
    private $PrimaryContactPersonID;
    private $AlternateContactPersonID;
    private $SupplierReference;
    private $InternalComments;
    private $WebsiteURL;
    private $LastEditedBy;
    private $AddressID;

    function __construct()
    {
            Parent::__construct();
            $this->table = "supplier";
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
    public function getSupplierName()
    {
        return $this->SupplierName;
    }

    /**
     * @param mixed $SupplierName
     */
    public function setSupplierName($SupplierName)
    {
        $this->SupplierName = $SupplierName;
    }

    /**
     * @return mixed
     */
    public function getPrimaryContactPersonID()
    {
        return $this->PrimaryContactPersonID;
    }

    /**
     * @param mixed $PrimaryContactPersonID
     */
    public function setPrimaryContactPersonID($PrimaryContactPersonID)
    {
        $this->PrimaryContactPersonID = $PrimaryContactPersonID;
    }

    /**
     * @return mixed
     */
    public function getAlternateContactPersonID()
    {
        return $this->AlternateContactPersonID;
    }

    /**
     * @param mixed $AlternateContactPersonID
     */
    public function setAlternateContactPersonID($AlternateContactPersonID)
    {
        $this->AlternateContactPersonID = $AlternateContactPersonID;
    }

    /**
     * @return mixed
     */
    public function getSupplierReference()
    {
        return $this->SupplierReference;
    }

    /**
     * @param mixed $SupplierReference
     */
    public function setSupplierReference($SupplierReference)
    {
        $this->SupplierReference = $SupplierReference;
    }

    /**
     * @return mixed
     */
    public function getInternalComments()
    {
        return $this->InternalComments;
    }

    /**
     * @param mixed $InternalComments
     */
    public function setInternalComments($InternalComments)
    {
        $this->InternalComments = $InternalComments;
    }

    /**
     * @return mixed
     */
    public function getWebsiteURL()
    {
        return $this->WebsiteURL;
    }

    /**
     * @param mixed $WebsiteURL
     */
    public function setWebsiteURL($WebsiteURL)
    {
        $this->WebsiteURL = $WebsiteURL;
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
    public function getAddressID()
    {
        return $this->AddressID;
    }

    /**
     * @param mixed $AddressID
     */
    public function setAddressID($AddressID)
    {
        $this->AddressID = $AddressID;
    }

}