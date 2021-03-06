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
        $discount = new discount();
        $discount = $discount->retrieve($id);
        if(empty($discount->getSpecialDealID()))
        {
            //header("Location: /404", true);
        }
        return $discount;
    }

    public function getDiscounts(){
        $discounts = $this->discount->getAllSpecialDeals();
        return $discounts;
    }
    function searchDiscounts($value){
        $discounts = $this->discount->where("*",["DiscountPercentage","DealDescription"], "Like",[$value, $value]);
        if($discounts != null && !empty($discounts) && $discounts[0]->getSpecialDealID() != null){
            return $discounts;
        } else{
            return null;
        }

    }
//    public function SearchCustomers($value){
//        $customers = $this->customer->getAllCustomers();
////        $people
//        var_dump($customers);
//
//        $input = preg_quote('bl', '~'); // don't forget to quote input string!
//        $data = array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');
//
//        $result = preg_grep('~' . $input . '~', $data);
//        return $customers;
//    }

    public function GetAllDiscount($discounts)
    {
        if($discounts != null){
            foreach($discounts as $discount){
                $result = '';
                $result .= '<tr>
                    <td style="min-height: 50px;" class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $discount->getSpecialDealID() .'">Edit</button></td>
                    <td style="min-height: 50px;" class="col-md-2">' . $discount->getDealCode() . '</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $discount->getDiscountPercentage() . "%" .'</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $discount->getOneTime() .'</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $discount->getActive() .'</td>
                    <td style="min-height: 50px;" class="col-md-3">' . $discount->getDealDescription() .'</td>
                    <td style="min-height: 50px;" class="col-md-1">'.  $this->discount->getProductBasedOnID($discount->getSpecialDealID()) .'</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $discount->getStartDate() .'</td>
                    <td style="min-height: 50px;" class="col-md-1">' . $discount->getEndDate() .'</td>
                </tr>';
                echo $result;
            }
        }


    }

    public function GetAllProducts()
    {
        $products = $this->product->retrieve();

        foreach ($products as $product) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedProductIDs[]" id="selectTableRow" value="'. $product->getStockItemID().'"></td>
                   <td class="col-md-2">' . $product->getStockItemID() . '</td>
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
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedCategoryIDs[]" id="selectTableRow" value="'. $category->getCategoryID().'"></td>
                   <td class="col-md-2">' . $category->getCategoryID() . '</td>
                   <td class="col-md-4">' . $category->getCategoryName() . '</td>
                   <td class="col-md-2">' . $category->getParentCategory() . '</td>
                   <td class="col-md-2">' . $category->getSpecialDealID() . '</td>
                </tr>';
            echo $result;
        }
    }
    function GetAllCategoriesForAttachments()
    {
        $categorys = $this->category->retrieve();

        foreach ($categorys as $category) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedCategoryIDs[]" id="selectTableRow" value="'. $category->getCategoryID().'"></td>
                   <td class="col-md-2">' . $category->getCategoryID() . '</td>
                   <td class="col-md-8">' . $category->getCategoryName() . '</td>
                </tr>';
            echo $result;
        }
    }
    public function GetAllProductsActive()
    {
        $products = $this->product->retrieve();

        foreach ($products as $product) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedProductIDs[]" id="selectTableRow" value="'. $product->getStockItemID().'"></td>
                   <td class="col-md-2">' . $product->getStockItemID() . '</td>
                   <td class="col-md-3">' . $product->getStockItemName() . '</td>
                   <td class="col-md-1">' . "€ " . $product->getUnitPrice() . ",- " . '</td>
                   <td class="col-md-4">' . $product->getMarketingComments() . '</td>
                </tr>';
            echo $result;
        }
    }

    function GetAllCategoriesForAttachmentsActive($MediaID)
    {
        $categorys = $this->category->retrieve();

        foreach ($categorys as $category) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectedCategoryIDs[]" id="selectTableRow" value="'. $category->getCategoryID().'"></td>
                   <td class="col-md-2">' . $category->getCategoryID() . '</td>
                   <td class="col-md-8">' . $category->getCategoryName() . '</td>
                </tr>';
            echo $result;
        }
    }
    public function create()
    {
       // print_r($_POST);
        $this->discount = new discount();
        $this->discount->initialize();

        //hierzou ie een special deal id moeten hebben
        $this->discount->setLastEditedBy(1);
        $this->storeDiscount($this->discount);

        if (isset($_POST["selectedProductIDs"])) {
            foreach ($_POST["selectedProductIDs"] as $id) {
                $this->product = $this->product->retrieve($id);
                $this->product->setSpecialDealID($this->discount->getSpecialDealID());
                $this->storeProduct($this->product);
            }
        }
        if (isset($_POST["selectedCategoryIDs"])) {
            foreach ($_POST["selectedCategoryIDs"] as $id) {
                $this->category = $this->category->retrieve($id);
                $this->category->setSpecialDealID($this->discount->getSpecialDealID());
                $this->storeCategory($this->category);
            }
        }

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
        if (isset($_POST["StockItemID"])) {
            foreach ($_POST["StockItemID"] as $id) {
                $this->product->retrieve($id);
                $this->product->setSpecialDealID($this->discount->getSpecialDealID());
                $this->storeProduct($this->product);
            }
        }
        if (isset($_POST["CategoryID"])){
            foreach ($_POST["CategoryID"] as $id) {
                $this->category->retrieve($id);
                $this->category->setSpecialDealID($this->category->getSpecialDealID());
                $this->storeCategory($this->category);
            }
        }
        if (isset($_POST["StartDate"])){
            $this->discount->setStartDate($_POST["StartDate"]);
        }

        $this->storeDiscount($this->discount);
        include $this->admin . 'onderhoudkorting.php';
    }

    public function stockitems($discount){
        $stockitems = $this->product->where("*", "SpecialDealID", "=", $discount->getSpecialDealID());

        return "";
    }

    /**
     * Stores the product in the database.
     *
     * @param $discount discount
     * @return string
     */
    public function storeDiscount($discount)
    {
        if (!$discount->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->discount = $discount;

        if (!$this->discount->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $product product
     * @return string
     */
    public function storeProduct($product)
    {


        if (!$product->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->product = $product;
        //var_dump($product);
        if (!$this->product->save())
        {
            return "Something went wrong.";
        }
    }

    /**
     * Stores the product in the database.
     *
     * @param $category Category
     * @return string
     */
    public function storeCategory($category)
    {

        if (!$category->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->category = $category;

        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
    }
}