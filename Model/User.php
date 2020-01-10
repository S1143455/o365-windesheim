<?php


namespace Model;


class User extends Database
{
    private $PersonID;
    private $Fullname;
    private $LogonName;
    private $HashedPassword;
    private $IsSystemUser;
    private $Role;
    private $PhoneNumber;
    private $EmailAddress;
    private $DateOfBirth;
    private $Photo;
    private $LastEditedBy;
    private $PassWordRecoveryString;
    private $RecoveryStringTTL;

    function __construct()
    {
        Parent::__construct();
        $this->table = 'people';
    }
    /**
     * @return mixed
     */
    public function getPersonID()
    {
        return $this->PersonID;
    }
    /**
    * @param mixed $PersonID
    */
    public function setPersonID($PersonID)
    {
        $this->PersonID = $PersonID;
    }
    /**
    * @return mixed
    */
    public function getFullname()
    {
    return $this->Fullname;
    }/**
     * @param mixed $Fullname
     */
    public function setFullname($Fullname)
    {
        $this->Fullname = $Fullname;
    }/**
     * @return mixed
     */
    public function getLogonName()
    {
        return $this->LogonName;
    }/**
     * @param mixed $LogonName
     */
    public function setLogonName($LogonName)
    {
        $this->LogonName = $LogonName;
    }/**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->HashedPassword;
    }/**
     * @param mixed $HashedPassword
     */
    public function setHashedPassword($HashedPassword)
    {
        $this->HashedPassword = $HashedPassword;
    }/**
     * @return mixed
     */
    public function getIsSystemUser()
    {
        return $this->IsSystemUser;
    }/**
     * @param mixed $IsSystemUser
     */
    public function setIsSystemUser($IsSystemUser)
    {
        $this->IsSystemUser = $IsSystemUser;
    }/**
     * @return mixed
     */
    public function getRole()
    {
        return $this->Role;
    }/**
     * @param mixed $Role
     */
    public function setRole($Role)
    {
        $this->Role = $Role;
    }/**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }/**
     * @param mixed $PhoneNumber
     */
    public function setPhoneNumber($PhoneNumber)
    {
        $this->PhoneNumber = $PhoneNumber;
    }/**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->EmailAddress;
    }/**
     * @param mixed $EmailAddress
     */
    public function setEmailAddress($EmailAddress)
    {
        $this->EmailAddress = $EmailAddress;
    }/**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->DateOfBirth;
    }/**
     * @param mixed $DateOfBirth
     */
    public function setDateOfBirth($DateOfBirth)
    {
        $this->DateOfBirth = $DateOfBirth;
    }/**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->Photo;
    }/**
     * @param mixed $Photo
     */
    public function setPhoto($Photo)
    {
        $this->Photo = $Photo;
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
    public function getPassWordRecoveryString()
    {
        return $this->PassWordRecoveryString;
    }
    /**
    * @param mixed $PassWordRecoveryString
    */
    public function setPassWordRecoveryString($PassWordRecoveryString)
    {
        $this->PassWordRecoveryString = $PassWordRecoveryString;
    }
    /**
    * @return mixed
    */
    public function getRecoveryStringTTL()
    {
        return $this->RecoveryStringTTL;
    }
    /**
    * @param mixed $RecoveryStringTTL
    */
    public function setRecoveryStringTTL($RecoveryStringTTL)
    {
        $this->RecoveryStringTTL = $RecoveryStringTTL;
    }

    // this sets the TTL of the passwordrecovery link.
    public function passwordRecoveryTime()
    {
        return $this->passwordRecoveryTime=600;
    }


}