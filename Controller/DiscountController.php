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
    public function GetAllDiscount()
    {
        $discounts = $this->discount->getAllSpecialDeals();

        foreach($discounts as $discount){
            $result = '';
            $result .= '<tr>
                    <td class="col-md-1"><button type="submit" class="btn btn-outline-secondary tableEditButton" name="id" value="' . $discount->getSpecialDealID() .'">Edit</button></td>
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
    public function create()
    {
        print_r($_POST);
        $this->discount = new discount();
        $this->discount->initialize();
        var_dump($this->discount);
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
        if ($_POST("StockItemID")) {
            foreach ($_POST["StockItemID"] as $id) {
                $this->product->retrieve($id);
                $this->product->setSpecialDealID($this->discount->getSpecialDealID());
                $this->storeProduct($this->product);
            }
        }
        if ($_POST("CategoryID")){
            foreach ($_POST["CategoryID"] as $id) {
                $this->category->retrieve($id);
                $this->category->setSpecialDealID($this->category->getSpecialDealID());
                $this->storeCategory($this->category);
            }
        }
        $this->storeDiscount($this->discount);
        include $this->admin . 'onderhoudkorting.php';
        return "";

    }

    public function stockitems($discount){
        $stockitems = $this->product->where("*", "SpecialDealID", "=", $discount->getSpecialDealID());
        //kijk hoe je dit checkts
//        if($stockitems != null){
//            return '<p>
//                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
//                           href="#tableCollapseProduct"
//                           role="button"
//                           aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
//                    </p>
//                    <div class="tableCollapseProduct">
//                        <div class="collapse multi-collapse" id="tableCollapseProduct">
//                            <div class="card card-body">
//                                <div class="row">
//                                    <input class="form-control collapseTableSearch" type="text"
//                                           placeholder="Waar ben je naar op zoek?"
//                                           aria-label="Search" id="myInputProduct"
//                                           onkeyup="searchbarProduct()">
//                                </div>
//                                <div class="col-12">
//                                    <table class="table table-responsive-lg tableCollapseSP"
//                                           id="tableCollapseProduct">
//                                        <thead>
//                                        <tr>
//                                            <th class="col-md-2">Select</th>
//                                            <th class="col-md-2">Productnr</th>
//                                            <th class="col-md-3">Productnaam</th>
//                                            <th class="col-md-1">Prijs</th>
//                                            <th class="col-md-4">Opmerkingen</th>
//                                        </tr>
//                                        </thead>
//                                        <tbody>
//
//                                        </tbody>
//                                    </table>
//                                </div>
//                            </div>
//                        </div>
//                    </div>
//';
//        }else{
        return "";
    }
//    }
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
            print_r($_GET);
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
        //var_dump($discount);

        if (!$product->initialize())
        {
            print_r($_GET);
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
            print_r($_GET);
            return false;
        };

        $this->category = $category;

        if (!$this->category->save())
        {
            return "Something went wrong.";
        }
    }
}