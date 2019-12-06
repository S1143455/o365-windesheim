<?php


use Model\Product;

echo 'test';

if (isset($_POST['submit'])) {
    include 'loader.php';
    $product = new Product();
    $product->initialize();
    $productController->store($product);
    die();
}

?>

<form method="POST">
    <div class="form-group">
        <label for="stockItemName">Product naam</label>
        <input type="text" class="form-control" name="StockItemName" id="stockItemName"
               aria-describedby="productnameSmall" placeholder="">
    </div>
    <div class="form-group">
        <label for="supplierID">SupplierID</label>
        <input type="number" class="form-control" name="SupplierID" id="supplierID">
    </div>
    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" name="Brand" id="brand">
    </div>
    <div class="form-group">
        <label for="loadTimeDays">LoadTimeDays</label>
        <input type="number" class="form-control" name="LoadTimeDays" id="loadTimeDays">
    </div>
    <div class="form-group">
        <label for="isChillerStock">IsChillerStock</label>
        <input type="number" class="form-control" name="IsChillerStock" id="isChillerStock">
    </div>
    <div class="form-group">
        <label for="barCode">BarCode</label>
        <input type="text" class="form-control" name="BarCode" id="barCode">
    </div>
    <div class="form-group">
        <label for="taxRate">TaxRate</label>
        <input type="number" class="form-control" name="TaxRate" id="taxRate">
    </div>
    <div class="form-group">
        <label for="unitPrice">UnitPrice</label>
        <input type="number" class="form-control" name="UnitPrice" id="unitPrice">
    </div>
    <div class="form-group">
        <label for="marketingComments">MarketingComments</label>
        <input type="text" class="form-control" name="MarketingComments" id="marketingComments">
    </div>
    <div class="form-group">
        <label for="unitPrice">UnitPrice</label>
        <input type="text" class="form-control" name="UnitPrice" id="unitPrice">
    </div>
    <div class="form-group">
        <label for="categoryID">Category</label>
        <input type="text" class="form-control" name="CategoryID" id="categoryID">
    </div>


    <input type="submit" name="submit" value="product" class="btn btn-primary">
</form>

