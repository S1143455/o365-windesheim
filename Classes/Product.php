<?php
namespace Classes;

use Classes\Database;
Class Product
{

    private $viewPath = 'views/product/';

    private $database;
    function __construct()
    {
        $this->database = new Database();
    }


    /**
     * This should return the index page of the products.
     * So a list of products should be retrieved on this page.
     */

    public function index()
    {
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
      return include_once $this->viewPath . 'create.php';
    }

    /**
     * Stores the product in the database.
     *
     * @param $product
     */
    public function store($product)
    {
        if(!$this->validate($product))
        {
            return 'Product not valid.';
        }
        $this->database->create("INSERT INTO stockitem (stockitemname) VALUES ('".$product['productname']."')");
        return "STORE FUNCTION EXECUTED";
    }

    /**
     * Validation of the input.
     * @param $product
     * @return bool
     */
    private function validate($product)
    {
        if(!isset($product['productname']))
        {
            return false;
        }
        return true;
    }

    /**
     * This method should Update a Product in the database
     * @param $id
     * @return mixed
     */

    public function update($id)
    {
        return include_once $this->viewPath .'update.php';
    }

    /**
     * This method should delete a Product from the database.
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return include_once $this->viewPath .'delete.php';
    }

    /**
     * This should return a single Product to the page.
     * The product should be retrieved by the database.
     *
     * @param $id
     */
    public function show($id)
    {
        return include_once $this->viewPath .'show.php';
    }
}