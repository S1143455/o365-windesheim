<?php

namespace Controller;

use Model\Category;
use Model\Product;
use Model\Supplier;
use Model\Attachments;
use Model\ShoppingCart;
use Controller\MainController;

Class ProductController
{
    private $viewPath = 'views/product/';

    private $product;

    private $category;
    private $supplier;
    private $attachments;
    private $cart;

    /**
     * This should return the index page of the products.
     * So a list of products should be retrieved on this page.
     */

    public function index()
    {
        $test = new Product();
        /**
         * Database.php  line 287-289  to remove the comments from the page.
         */
//        $products = new Product();
//        $products = $products->retrieve();

//        $categories = new Category();
//        $categories = $categories->retrieve();


        $categories = new Category();
        $categories = $categories->retrieve();

        return include $this->viewPath . 'index.php';
    }

    /**
     * This method should capture the creation of a new object,
     * Verify its data and commit it to the database.
     * @param $newProduct
     * @return mixed
     */
    public function create()
    {
        $this->product = new Product();
        $this->product->setStockItemID(10);
        include $this->viewPath . 'create.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $product Product
     * @return string
     */
    public function store($product)
    {
        if (!$product->initialize())
        {
            //print_r($_GET);
            return false;
        };

        $this->product = $product;

        if (!$this->product->save())
        {
            return "Something went wrong.";
        }
    }


    /**
     * This method should Update a Product in the database
     * @param $id
     * @return mixed
     */

    public function update($id)
    {

        return include_once $this->viewPath . 'update.php';
    }

    /**
     * This method should delete a Product from the database.
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return include_once $this->viewPath . 'delete.php';
    }

    /**
     * This should return a single Product to the page.
     * The product should be retrieved by the database.
     *
     * @param $id
     */
    public function show($id)
    {
        $product = new Product();
        $product = $product->retrieve($id);
        if(empty($product->getStockItemID()))
        {
//            header("Location: /404", true);
        }

        echo '<br>'. $product->getStockItemName() .'<br>';
        //var_dump($this->viewPath);
        return include_once $this->viewPath . 'show.php';
    }
    public function show1($id)
    {
        $product = new Product();
        $product = $product->retrieve($id);
        if(empty($product->getStockItemID()))
        {
//            header("Location: /404", true);
        }

        echo '<br>'. $product->getStockItemName() .'<br>';
        //var_dump($this->viewPath);
        //var_dump(getenv('template'));
        header("Location: /".  getenv('ROOTAdmin') ."/product/". $product->getStockItemID() . "");
        return true;
        //return include_once $this->viewPath . 'show.php';
    }
    public function admin(){
        $product = new Product();
        $products = $product->retrieve();

        $category = new Category();

        $supplier = new Supplier();
        $suppliers = $supplier->retrieve();
        //var_dump($this->viewPath);
        return include_once $this->viewPath . 'admin.php';
    }
    function searchProduct($products, $field, $value)
    {
        foreach($products as $key => $product)
        {
            if ( $product[$field] === $value )
                return $key;
        }
        return false;
    }
    public function getSizeString($sz){
        switch ($sz) {
            case 1:
                $sz = 'Extra klein';
                break;
            case 2:
                $sz = 'Klein';
                break;
            case 3:
                $sz = 'Middel';
                break;
            case 4:
                $sz = 'Groot';
                break;
            case 5:
                $sz = 'Extra groot';
                break;
            default:
                $sz = 'Onbekend';
        }
        return $sz;
    }

    public function calculatePrice($price,$btw){
        return $price - ($price/100*$btw);
    }

    public function productDetail(){
        if(isset($_POST['srchProduct'])){

            $main = new MainController();
            $cart= new shoppingCart();
            $attachment = new attachments();
            $product = new product();
            $prod = $product->retrieve($_POST['productID']);
            include_once('views/product/productdetail.php');
        }
    }
}