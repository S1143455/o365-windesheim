<?php


use Model\Product;
if (isset($_POST['submit'])) {
    include 'loader.php';
    $product = new Product();


    $productController->store($product);
    die();
}

?>
<form method="POST">
    <div class="form-group">
        <label for="stockItemName">Product naam</label>
        <input type="text" class="form-control" name="StockItemName" id="stockItemName"
               aria-describedby="productnameSmall">
    </div>
    <div class="form-group">
        <label for="supplierID">SupplierID</label>
        <input type="number" class="form-control" name="SupplierID" id="supplierID" value="1">
    </div>
    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" name="Brand" id="brand">
    </div>
    <div class="form-group">
        <label for="LeadTimeDays">LeadTimeDays</label>
        <input type="number" class="form-control" name="LeadTimeDays" id="LeadTimeDays">
    </div>
    <div class="form-group">
        <label for="isChillerStock">IsChillerStock</label>
        <input type="number" class="form-control" name="IsChillerStock" id="isChillerStock" value="1">
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
        <label for="categoryID">Category</label>
        <input type="number" class="form-control" name="CategoryID" id="categoryID" value="1">
    </div>


    <input type="submit" name="submit" value="product" class="btn btn-primary">
</form>
<script
        src="http://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>

    $('input').each(function(){
        if($(this).attr('type') == 'text' ){
            $(this).val($(this).attr('name'))
        }
        else if($(this).attr('type') == 'number' && $(this).val() == "")
        {
            $(this).val(Math.round(Math.random() * 10 ));
        }
    })

</script>