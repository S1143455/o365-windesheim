<?php
namespace Classes;

Class Product{

    /**
     * This should return the index page of the products.
     * So a list of products should be retrieved on this page.
     */
    public function Index()
    {
        return include_once '../views/product/index.php';
    }

    /**
     * This method should capture the creation of a new object,
     * Verify its data and commit it to the database.
     * @param $newProduct
     * @return mixed
     */
    public function Create($newProduct)
    {
      return include_once '../views/product/create.php';
    }

    /**
     * This method should Update a Product in the database
     * @param $id
     * @return mixed
     */
    public function Update($id)
    {
        return include_once '../views/product/update.php';
    }

    /**
     * This method should delete a Product from the database.
     * @param $id
     * @return mixed
     */
    public function Delete($id)
    {
        return include_once '../views/product/delete.php';
    }

    /**
     * This should return a single Product to the page.
     * The product should be retrieved by the database.
     *
     * @param $id
     */
    public function Show($id)
    {

    }
}