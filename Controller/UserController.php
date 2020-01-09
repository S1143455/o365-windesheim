<?php

namespace Controller;
use Model\Customer;
use Model\Database;
use Model\User;
use Model\Adress;

class UserController
{
    private $templatePath;
    private $contentPath;
    function __construct()
    {
        $this->templatePath = getenv('TEMPLATEPATH');
        $this->contentPath = getenv('CONTENTPATH');
        $this->user = new User();
        $this->customer = new Customer();
        $this->addres = new Adress();
    }
    public function getCustomerByID($id){
        $this->customer = $this->customer->retrieve($id);
        return $this->customer;
    }
    public function getAdressByID($id){
        $this->addres = $this->addres->retrieve($id);
        return $this->addres;
    }
    public function retrieveUser($id){
        $user = new user();
        $user = $user->retrieve($id);
        if(empty($user->getPersonID()))
        {
            //header("Location: /404", true);
        }

        return $user;
    }
    public function getUsername()
    {
        if (isset($_SESSION['USERAdmin']))
        {
            return $_SESSION['USERAdmin']['LogonNameAdmin'];
        }
        return 'Login';
    }
    public function isAdmin()
    {
        return true;
    }
    public function retrievebylogin($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        return $user;
    }

    /**
     * Stores the product in the database.
     * @return User
     */
    public function GetUserBydata($return, $key, $id)
    {
        $user = $this->user->where($return, $key, $id);
        return $user[0];
    }
    public function GetEmailByName($return, $key, $id){
        $user = $this->user->databaseWhere($return,$key,$id);
        //var_dump($user);
        return true;
    }


    /**
     * Stores the product in the database.
     *
     * @param $user User
     * @return string
     */
    public function storeUser($user)
    {
        if (!$user->initialize())
        {
            return false;
        };
        $this->user = $user;

        if (!$this->user->save())
        {
            return "Something went wrong.";
        }
    }
    /**
     * Stores the product in the database.
     *
     * @param $address Adress
     * @return string
     */
    public function storeAdress($address)
    {
        if (!$address->initialize())
        {
            return false;
        };
        $this->addres = $address;

        if (!$this->addres->save())
        {
            return "Something went wrong.";
        }
    }
    /**
     * Stores the product in the database.
     *
     * @param $user1 User
     * @return string
     */
    public function update($user1)
    {
        $this->storeUser($user1);

    }

    public function getdata()
    {
        $getthedata=new Database();
        //todofixpls Nope! fixing it would over complicate the shit out if it!
        $sqlreturendsomething=$getthedata->selectStmt("SELECT * FROM people WHERE LogonName = '". $this->user->getLogonName()  . "'");

        return $sqlreturendsomething;

    }
    /**
     * Login for the user.
     * @param $username
     * @param $password
     * @return array
     */
    function login($username, $password)
    {
        if($username == '' || $password  == '')
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'warning', "message"=>'Vul een gebruikersnaam en wachtwoord in.'];
        }
        if($this->checkCredentials($username, $password))
        {
            // Check if the passwords match.
//            $this->user->setRole("ADMIN");
//            $this->storeUser($this->user);
//            $this->user->retrieve($this->user->getPersonID());
            if ($this->verifyPassword($password,$this->user->getHashedPassword()) and $this->user->getRole() == "ADMIN")
            {
                $_SESSION['authenticatedAdmin']='true';
                $_SESSION['USERAdmin']= $this->user;
                $customerDetails = $this->getCustomerByID($_SESSION['USERAdmin']->getPersonID());
                $_SESSION['CUSTOMER_DETAILSAdmin']=$customerDetails;
                $addressDetails = $this->getAdressByID($_SESSION['USERAdmin']->getPersonID());
                $_SESSION['ADDRESSAdmin']=$addressDetails;
                $_SESSION['USER']['DATA']=$this->getdata();
                $_SESSION['LOGIN_ERROR']=['type'=>'success', 'message'=>'U bent ingelogd'];
                echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/" . getenv('ROOT') . "\">";
            }
            else
            {
                if($this->user->getRole() != "ADMIN"){
                    $this->unsetData();
                    return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Dit account is geen Admin.'];
                }else{
                    $this->unsetData();
                    return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
                }

            }
        }

    }
    function gotoLogin()
    {
       echo "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/". $this->templatePath  . "/admin/login\">";
    }
    public function unsetData(){
        unset($_SESSION['authenticatedAdmin']);
        unset($_SESSION['USERAdmin']);
        unset($_SESSION['CUSTOMER_DETAILSAdmin']);
        unset($_SESSION['ADDRESSAdmin']);


        $this->user = new user();
    }
    /**
     * Hash the users password on registration.
     * @param $password
     * @return bool|string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verifies the user password.
     * @param $inputPassword
     * @param $dbPassword
     * @return bool
     */
    private function verifyPassword($inputPassword, $dbPassword)
    {
       // echo $dbPassword;
        return password_verify($inputPassword, $dbPassword);
    }

    /**
     * Registers the user.
     * @param $data
     */
    function register($data)
    {

    }
    function logout()
    {
        if (isset($_SESSION['authenticatedAdmin'])) {
            unset($_SESSION['authenticatedAdmin']);
            unset($_SESSION['USERAdmin']);
        }
    }

    function isAuthenticated()
    {

        if (isset($_SESSION['authenticatedAdmin'])) {
            return "Welkom, " . $this->user->getLogonName();
        } else {
            return " | <a class='pull-right' href='/admin/login'>Login</a>";
        }
    }

    function role(){
        return 'role';
    }

    public function checkCredentials($logonName,$password)
    {
        $user = $this->user->where("*", "LogonName", "=", $logonName);
        if(empty($user))
        {
            return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            $this->user = $user[0];
            return true;
        }
    }

    public function passwordRecoveryTime()
    {
        return $this->passwordRecoveryTime=600;
    }
    public function databaseWhere($return, $key, $id){
        $retrieved = $this->where($return, $key, "=", $id);
        return $retrieved;
    }

}

