<?php


namespace Model;


//    private PreferredName;
//    private SearchName;
//    private IsPermittedToLogon;
//    private IsExternalLogonProvider
//    private IsEmployee;
//    private IsSalesperson;
//    private UserPreferences;
//    private FaxNumber;
//    private CustomFields;
//    private OtherLanguages;
//    private ValidFrom;
//    private ValidTo
//    private $username;
//    private $password;
//    private $dbPassword;
//    private  $UserDataArray;
//    private $passwordRecoveryTime;
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


//BEGIN SVEN SHIT !
    private $username;
    private $password;
    protected $table;
    private $dbPassword;
    private  $UserDataArray;
    private $passwordRecoveryTime;
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * @param $dbPassword
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }
    public function getDbPassword()
    {
        return $this->dbPassword;
    }
    public function setUserDataArray($sqlreturendsomething)
    {
        $this->UserDataArray = $sqlreturendsomething;
    }
    public function  getUserDataArray()
    {
        return $this->UserDataArray;
    }
    public function checkCredentials()
    {
        $getthedata=new Database();
        //todofixpls Nope! fixing it would over complicate the shit out if it!
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM people WHERE LogonName = '".$this->username . "'");
        if(!$sqlreturendsomething)
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            // return the password found in te database and place the userdata in a variable.
            $this->setUserDataArray($sqlreturendsomething);
            $this->setDbPassword($sqlreturendsomething[0]['HashedPassword']);
            return true;
        }
    }
    // this sets the TTL of the passwordrecovery link.
    public function passwordRecoveryTime()
    {
        return $this->passwordRecoveryTime=600;
    }


    //EINDE SVEN SHIT !
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