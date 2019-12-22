<?php


namespace Controller;


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
    }

    function GetAllDiscount()
    {
        $discounts = $this->discount->getAllSpecialDeals();

        foreach($discounts as $discount){
            $result = '';
            $result .= '<tr>
                    <td class="col-md-2">' . $discount->getDealCode() .'</td>
                    <td class="col-md-1">' . $discount->getDiscountPercentage() .'</td>
                    <td class="col-md-1">' . $discount->getOneTime() .'</td>
                    <td class="col-md-1">' . $discount->getActive() .'</td>
                    <td class="col-md-3">' . $discount->getDealDescription() .'</td>
                    <td class="col-md-2">'.  $this->discount->getProductBasedOnID($discount->getSpecialDealID()) .'</td>
                    <td class="col-md-1">' . $discount->getStartDate() .'</td>
                    <td class="col-md-1">' . $discount->getEndDate() .'</td>
                </tr>';
            echo $result;
        }

    }

    function GetAllProducts()
    {
        $products = $this->product->retrieve();
        //$discounts = $this->discount->getAllProducts();

        foreach ($products as $product) {
            $result = '';
            $result .= '<tr>
                   <td class="col-md-2"><input class="selectTableRow" type="checkbox" name="selectTableRow" id="selectTableRow"></td>
                   <td class="col-md-2">' . $product->getBrand() . '</td>
                   <td class="col-md-3">' . $product->getStockItemName() . '</td>
                   <td class="col-md-1">' . $product->getUnitPrice() . '</td>
                   <td class="col-md-4">' . $product->getMarketingComments() . '</td>
                </tr>';
            echo $result;
        }
    }

    function GetAllCategories()
    {
        $categorys = $this->category->retrieve();
        //$discounts = $this->discount->getAllCategories();

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
        //die("die");
        //$this->category->setCategoryID();
        $this->discount->setLastEditedBy(1);

        $this->store($this->discount);

        // return "true";
        // include $this->contentpath
        include $this->admin . 'onderhoudkorting.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $discount discount
     * @return string
     */
    public function store($discount)
    {
        var_dump($discount);

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
}