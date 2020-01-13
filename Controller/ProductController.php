<?php

namespace Controller;

use Model\AttachmentCategorie;
use Model\Attachments;
use Model\AttachmentStockItem;
use Model\Category;
use Model\Orderline;
use Model\Product;
use Model\Supplier;
use Model\ShoppingCart;
use Controller\MainController;

Class ProductController extends FileController
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
    public function createAdminProduct()
    {
        $product = new Product();
        $product->initialize();
        $product->save();
        if (isset($_FILES) && $_FILES['attachmentIMG'] != null && $_FILES["attachmentIMG"]["tmp_name"][0] != null) {
            $attachments = $this->uploadMultiple(count($_FILES["attachmentIMG"]["name"]), $_SESSION['personID']);
            foreach($attachments as $attachment){
                $AttachmentStockItem = new AttachmentStockItem();
                $AttachmentStockItem->setAttachmentID($attachment->getAttachmentID());
                $AttachmentStockItem->setStockitemID($product->getStockItemID());
                $AttachmentStockItem->setLastEditedBy($_SESSION['personID']);
                $this->storeStock($AttachmentStockItem);
            }
        }

        if(!empty($_POST['URL'])){

            $attachment = new Attachments();
            $attachment->setURL($_POST['URL']);
            $attachment->setLastEditedBy($_SESSION['personID']);
            $attachment->setActive(1);
            $attachment = $this->storeAttachment($attachment);
            $AttachmentStockItem = new AttachmentStockItem();
            $AttachmentStockItem->setAttachmentID($attachment->getAttachmentID());
            $AttachmentStockItem->setStockitemID($product->getStockItemID());
            $AttachmentStockItem->setLastEditedBy($_SESSION['personID']);
            $this->storeStock($AttachmentStockItem);
        }
        header("Location: /".  getenv('ROOTAdmin') ."/onderhoud-producten");


    }
    public function updateAdminProduct()
    {

        $product = new Product();
        $product = $this->retrieveProduct($_POST['StockItemID']);
        $product->initialize();
        $product->save();
        if (isset($_FILES) && $_FILES['attachmentIMG'] != null && $_FILES["attachmentIMG"]["tmp_name"][0] != null) {
            $attachments = $this->uploadMultiple(count($_FILES["attachmentIMG"]["name"]), $_SESSION['personID']);
            foreach($attachments as $attachment){
                $AttachmentStockItem = new AttachmentStockItem();
                $AttachmentStockItem->setAttachmentID($attachment->getAttachmentID());
                $AttachmentStockItem->setStockitemID($product->getStockItemID());
                $AttachmentStockItem->setLastEditedBy($_SESSION['personID']);
                $this->storeStock($AttachmentStockItem);
            }
        }
        var_dump($_POST);
        if(!empty($_POST['attachmentURL'])){

            $attachment = new Attachments();
            $attachment->setURL($_POST['attachmentURL']);
            $attachment->setLastEditedBy($_SESSION['personID']);
            $attachment->setActive(1);
            $attachment = $this->storeAttachment($attachment);
            $AttachmentStockItem = new AttachmentStockItem();
            $AttachmentStockItem->setAttachmentID($attachment->getAttachmentID());
            $AttachmentStockItem->setStockitemID($product->getStockItemID());
            $AttachmentStockItem->setLastEditedBy($_SESSION['personID']);
            $this->storeStock($AttachmentStockItem);
        }
        header("Location: /".  getenv('ROOTAdmin') ."/onderhoud-producten");


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
    public function getURL($productID){
        $attachmentStockItems = new AttachmentStockItem();
        $attachment = new Attachments();

        $attachmentStockItems =  $this->retrieveWhereStockitemBackwards($productID);
        $attachment =  $this->retrieveWhereAttachmentID($attachmentStockItems[0]->getAttachmentID());
        return $attachment->getURL();
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
    public function getConversionRatio($product){
        $Orderlines = new Orderline();
        $amount = 0;

        $orderlines = $Orderlines->where("*","StockItemID","=", $product->getStockItemID());
        $int_var = (int)$product->getTimesVisited();

        $amount = count($orderlines) + 10;
        $conversion = $int_var / $amount;
        return $conversion;
    }
    public function getTotalConversion($products){
        $amount = 0;
        $timesVisited = 0;
        foreach($products as $product){
            $orderlines = $this->Orderlines->where("*","StockItemID","=", $product->getStockItemID());
            $amount = $amount + count($orderlines);
            $timesVisited = $timesVisited + $product->getTimesVisited();
        }

        return $timesVisited / $amount;
    }
    public function calculatePrice($price,$btw){
        $basebtw = 100 + $btw;
        $baseprice = $price/100;
        $total = $baseprice*$basebtw;
        return $total;
    }

    public function productDetail(){
        $main = new MainController();
        $cart= new shoppingCart();
        $attachment = new attachments();
        $product = new product();

        if(isset($_POST['srchProduct']) || isset($_POST['add']) || isset($_POST['imgBack']) || isset($_POST['imgForward'])) {
            $prod = $product->retrieve($_POST['productID']);
        }

        include_once('views/product/productdetail.php');
    }
}