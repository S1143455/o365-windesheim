<?php


namespace Controller;


use Model\Database;
use Model\Discount;
use Model\Category;
use Model\Product;


class DiscountController
{
    private $admin = 'content/backend/';

    function __construct()
    {
        $this->discount = new Discount();
        $this->product = new Product();
        $this->category = new Category();
        $this->database = new Database();
    }
    public function retrieve($id){
        echo "hoi";
        $discount = new discount();
        $discount = $discount->retrieve($id);
        if(empty($discount->getSpecialDealID()))
        {
            //header("Location: /404", true);
        }

        return $discount;
    }
    function GetAllDiscount()
    {
        $discounts = $this->discount->getAllSpecialDeals();

        foreach($discounts as $discount){
            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" name="id" value="' . $discount->getSpecialDealID() .'">Edit</button></td>
                    <td class="col-md-2">' . $discount->getDealCode() . '</td>
                    <td class="col-md-1">' . $discount->getDiscountPercentage() . "%" .'</td>
                    <td class="col-md-1">' . $discount->getOneTime() .'</td>
                    <td class="col-md-1">' . $discount->getActive() .'</td>
                    <td class="col-md-3">' . $discount->getDealDescription() .'</td>
                    <td class="col-md-1">'.  $this->discount->getProductBasedOnID($discount->getSpecialDealID()) .'</td>
                    <td class="col-md-1">' . $discount->getStartDate() .'</td>
                    <td class="col-md-1">' . $discount->getEndDate() .'</td>
                </tr>';
            echo $result;
        }

    }

    function GetAllProducts()
    {
        $products = $this->product->retrieve();

        foreach ($products as $product) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="StockItemID" id="selectTableRow" value="'. $product->getStockItemID().'"></td>
                   <td class="col-md-2">' . $product->getBrand() . '</td>
                   <td class="col-md-3">' . $product->getStockItemName() . '</td>
                   <td class="col-md-1">' . "€ " . $product->getUnitPrice() . ",- " . '</td>
                   <td class="col-md-4">' . $product->getMarketingComments() . '</td>
                </tr>';
            echo $result;
        }
    }

    function GetAllCategories()
    {
        $categorys = $this->category->retrieve();

        foreach ($categorys as $category) {
        $result = '';
        $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectTableRow" id="selectTableRow"></td>
                   <td class="col-md-2">' . $category->getCategoryID() . '</td>
                   <td class="col-md-4">' . $category->getCategoryName() . '</td>
                   <td class="col-md-4">' . $category->getParentCategory() . '</td>
                </tr>';
        echo $result;
        }
    }
    public function create()
    {
        print_r($_POST);
        $this->discount = new discount();
        $this->discount->initialize();
        var_dump($this->discount);

        $this->discount->setLastEditedBy(1);

        $this->store($this->discount);

        // include $this->contentpath
        include $this->admin . 'onderhoudkorting.php';
        return "";

    }
    public function update()
    {

        $this->discount = new discount();
        $this->discount->initialize();
        //ingelogde gebruiker
        $this->discount->setLastEditedBy(1);
        if ($_POST("StockItemID")) {
            foreach ($_POST["StockItemID"] as $id) {
                $this->product->retrieve($id);
                $this->product->setSpecialDealID($this->discount->getSpecialDealID());
                $this->productController->store($this->product);
            }
        }
        $this->store($this->discount);
        include $this->admin . 'onderhoudkorting.php';
        return "";

    }

    /**
     * Stores the product in the database.
     *
     * @param $discount discount
     * @return string
     */
    public function store($discount)
    {
        //var_dump($discount);

        if (!$discount->initialize())
        {
            print_r($_GET);
            return false;
        };

        $this->discount = $discount;
var_dump($this->discount);
        if (!$this->discount->save())
        {
            return "Something went wrong.";
        }
    }
}