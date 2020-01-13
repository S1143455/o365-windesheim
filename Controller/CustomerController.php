<?php


namespace Controller;

use Model\Customer;
use Model\Order;
use Model\People;
use Model\Adress;


class CustomerController
{
    private $viewPath = 'content/frontend/';
    private $admin = 'content/backend/';
    private $route = 'content/frontend/';

    function __construct()
    {
        $this->customer = new Customer();
        $this->people = new People();
        $this->adress = new Adress();
        $this->order = new Order();

    }

    public function update()
    {
        $this->customer = $this->retrieve($_POST["CustomerID"]);
        $this->people = $this->retrievePerson($_POST["PersonID"]);
        $this->adress = $this->retrieveWhereP($_POST["AddressId"]);

        foreach ($_POST as $key => $value) {

            //$this->customer->set($_POST["EmailAddress"]);

            switch ($key) {
                case "FullName":
                    $this->people->setFullName($value);
                    break;
                case "DateOfBirth":
                    $this->people->setDateOfBirth($_POST["DateOfBirth"]);
                    break;
                case "Adress":
                    $this->adress->setAddress($_POST["Adress"]);
                    break;
                case "Zipcode":
                    $this->adress->setZipcode($_POST["Zipcode"]);
                    break;
                case "City":
                    $this->adress->setCity($_POST["City"]);
                    break;
                case "EmailAddress":
                    $this->people->setEmailAddress($_POST["EmailAddress"]);
                    break;
                case "Newsletter":
                    $this->customer->setNewsLetter($_POST["Newsletter"]);
                    break;

                default:
                }
            }
            var_dump($_POST);
            $this->customer->setTermsAndConditions(1);
            $this->store($this->customer);
            $this->storePeople($this->people);
            $this->storeAdress($this->adress);

            include $this->admin . 'home-admin.php';
    }

    /**
     * This method should capture the creation of a new object,
     * Verify its data and commit it to the database.
     * @param $newCustomer
     * @return mixed
     */

    public function createR()
    {
        $this->customer = new Customer();
        $this->customer->setCustomerID(10);
        include  $this->viewPath . 'account-toevoegen.php';
        $this->people = new People();
        $this->adress = new Adress();

    }

    public function retrieve($id){
        $customer = new customer();
        $customer = $customer->retrieve($id);
        if(empty($customer->getCustomerID()))
        {
            //header("Location: /404", true);
        }
        return $customer;
    }

    public function retrievePerson($id){
        $person = new People();
        $person = $person->retrieve($id);
        if(empty($person->getPersonID()))
        {
            //header("Location: /404", true);
        }

        return $person;
    }

    public function retrieveOrder($CustomerID){
        $order = new Order();
        $order = $this->order->where("*", "CustomerID", "=", $CustomerID);
        if(empty($order))
        {
            //header("Location: /404", true);
        }

        return $order;
    }

    public function getallcustomers(){
        $customers = $this->customer->getAllCustomers();
        return $customers;
    }

    public function SearchCustomers($value){
        $customers = $this->customer->getAllCustomers();

        $input = preg_quote('bl', '~'); // don't forget to quote input string!
        $data = array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');

        $result = preg_grep('~' . $input . '~', $data);
        return $customers;
    }

    public  function retrieveWhereP($personID){
        $address = new Adress();
        $address = $address->where("*", "PersonID", "=", $personID);
        if(empty($address))
        {
            // return $_SESSION['LOGIN_ERROR']=["type"=>'danger', "message"=>'Gebruikersnaam of wachtwoord onjuist.'];
        }
        else
        {
            return $address[0];
        }
    }

    function getAllCustomer()
    {
        $customers = $this->customer->getAllCustomers();
        foreach ($customers as $customer){
            $person =  $this->retrievePerson($customer->getPersonID());
            $adress = $this->retrieveWhereP($person->getPersonID());
            if($adress != null){
            }
            $result = '';
            $result .= '<tr>
                    <td style="min-height: 50px;" class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $customer->getCustomerID() .'">Edit</button></td>
                    <td style="min-height: 50px;" class="col-md-2">' . $customer->getCustomerID() . '</td>                 
                    <td style="min-height: 50px;" class="col-md-3">' . $person->getEmailAddress() .'</td>
                    <td style="min-height: 50px;" class="col-md-3">' . $person->getFullName() .'</td>
                    <td style="min-height: 50px;" class="col-md-2">' . $this->customer->getLastOrderDateOnID($customer->getCustomerID()) .'</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $customer->getNewsletter() .'</td>
                </tr>';
            echo $result;
        }

    }

    public function createBE()
    {
        $this->customer = new Customer();
        $this->customer->initialize();

        $this->store($this->customer);

        include $this->admin . 'onderhoudklanten.php';
    }
    function Test_Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function createMultipleP(){

        $this->customer = new Customer();
        $this->people = new People();
        $this->people->setIsSystemUser(0);
        $this->people->setRole("CUSTOMER");
        $this->people->setPhoto(NULL);
        $this->people->setLastEditedBy(1);
        foreach ($_POST as $key => $value)
        {

            switch ($key)
            {
                case "FullName":
                    $this->people->setFullName($value);
                    break;
                case "LogonName":
                    $this->people->setLogonName($value);
                    break;
                case "EmailAddress":
                    $this->people->setEmailAddress($value);
                    break;
                case "PhoneNumber":
                    $this->people->setPhoneNumber($value);
                    break;
                case "NewsLetter":
                    if($value == "on"){
                        $this->customer->setNewsLetter(1);
                    }else{
                        $this->customer->setNewsLetter(0);
                    }
                    break;
                case "TermsAndConditions":
//                    var_dump($value);
                    if($value == "on"){
                        $this->customer->setTermsAndConditions(1);
                    }else{
                        $this->customer->setTermsAndConditions(1);
                    }
                    break;
                case "Gender":
                    $this->customer->setGender($value);
                    break;
                case "HashedPassword":
                    $this->people->setHashedPassword(password_hash($value,PASSWORD_BCRYPT));
                    break;
                case  "dateofbirth":
                    $this->people->setDateOfBirth($value);
                    break;
                default:
                    //var_dump($key);


 // PersonID,
                // FullName,
                // LogonName,
                // HashedPassword,
                // PhoneNumber,
                // EmailAddress,
                // IsSystemUser,
                // Role,
                // DateOfBirth,
                // Photo,
                // LastEditedBy,
                // PassWordRecoveryString,
                // RecoveryStringTTL
 // CustomerID, AddressID, ShoppingCartID, Gender, newsletter, TermsAndConditions,



            }
            //var_dump($value);
            //var_dump($key);
        }
        $this->storePeople($this->people);
        $this->customer->setPersonID($this->people->getPersonID());
        $this->store($this->customer);
        include $this->route . 'account-toevoegen.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $customer customer
     * @return string
     */

    public function store($customer)
    {

        if (!$customer->initialize()) {
            return false;
        };

        $this->customer = $customer;

        if (!$this->customer->save()) {
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
        $this->adress = $address;

        if (!$this->adress->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $people People
     * @return string
     */
    public function storePeople($people)
    {
        if (!$people->initialize())
        {
            return false;
        };
        $this->people = $people;

        if (!$this->people->save())
        {
            return "Something went wrong.";
        }
    }
}