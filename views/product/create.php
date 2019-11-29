<?php
if(isset($_POST['product']))
{
    include 'loader.php';
    $product = new Classes\Product();
    $product->store($_POST['product']);
    die();
}

?>

<form>
    <div class="form-group">
        <label for="productname">Product</label>
        <input type="email" class="form-control" id="productname" aria-describedby="productnameSmall" placeholder="P">
        <small id="productnameSmall" class="form-text text-muted">Small</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

