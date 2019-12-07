<?php

namespace Controller;


use Model\Product;


Class ProductController
{

    private $viewPath = 'views/product/';
    private $product;

    /**
     * This should return the index page of the products.
     * So a list of products should be retrieved on this page.
     */

    public function index()
    {

        $product = new Product();
//        $product->setStockItemID(null);
//        $product->save();
//
//
//        $product1 = new Product();
//        $product1->setStockItemID(1);
//        $product2 = new Product();
//        $product2->setStockItemID(2);
//        $product3 = new Product();
//        $product3->setStockItemID(3);
//        $product4 = new Product();
//        $product4->setStockItemID(4);
//        $product5 = new Product();
//        $product5->setStockItemID(5);

//        $products = [$product1,$product2,$product3,$product4, $product5];
//        $this->products = [$product1,$product2,$product3,$product4, $product5];

        $product->retrieve();

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
            print_r($_GET);
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
        return include_once $this->viewPath . 'show.php';
    }
}