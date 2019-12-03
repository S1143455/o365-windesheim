<?php


echo 'test';

if(isset($_POST['submit']))
{
    include 'loader.php';
    die();
}

?>

<form method="POST">
    <div class="form-group">
        <label for="productname">Product</label>
        <input type="text" class="form-control" name="productname" id="productname" aria-describedby="productnameSmall" placeholder="">
    </div>
    <input type="submit" name="submit" value="product" class="btn btn-primary">
</form>

