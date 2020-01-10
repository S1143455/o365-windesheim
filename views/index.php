<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';

$cat_srch = false;
$prod_srch = false;
$prod_counter = 1;
$last = false;
$i = 1;

//navigation
if(isset($_POST['previous'])){
    $cat_to_srch = $_POST['categoryID'];

    if($cat_to_srch != '') {
        $cat_srch = true;
    }

    $prod_counter = $_POST['prodCounter'] - 6;
}
if(isset($_POST['next'])){
    $cat_to_srch = $_POST['categoryID'];

    if($cat_to_srch != '') {
        $cat_srch = true;
    }
    $prod_counter = $_POST['prodCounter'] + 6;
}

if ($prod_counter < 1){
    $prod_counter = 1;
}

//product search
if(isset($_POST['srchProduct'])){
    $prod_srch = true;
}

//category search OR back from productDetail
if(isset($_POST['srchCategory']) || isset($_POST['prdBack'])){
    $cat_srch = true;
    $cat_to_srch = $_POST['categoryID'];
    $prod_counter = 1;
}

//category previous
if(isset($_POST['back'])){
    $cat_to_srch = $category->retrieve($_POST['categoryID'])->getParentCategory();
    if ($cat_to_srch != ''){
        $cat_srch = true;
    }
    $prod_counter = 1;
}

if($cat_srch){
    $cat_parent = $category->retrieve($cat_to_srch);
    $categories = $category->where("*", "ParentCategory", "=", $cat_parent->getCategoryID());
}else{
    $cat_parent = '';
    $categories = $category->retrieve();
}
?>
    <div>
        <?php if($cat_srch){
            echo '<form method="post" action="'. $this->root . '" >';
            echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat_parent->getCategoryID() . '">';
            echo '<button name="back" type="submit">Terug</button>';
            echo '</form>';
        };?>

        <div id="adv" class="col-md-12 banner">
        <?php if ($cat_srch and $cat_parent->getCategoryID() != ''){echo '<h3>' . $cat_parent->getCategoryName() . '</h3>';}; ?>
        </div>

        <?php if (!$cat_srch){ ?>
        <div id="info">
            <?php $this->showContent("TITLE"); ?>
            <br>
            <?php $this->showContent("SUBTITLE"); ?>

            <?php $this->showContent("STORY");
            };
        ?>
    </div>

        <div id="categories" class="padding-top1em">
            <?php if(!$cat_srch){
                echo '<h3>Kies je lekkerste chocoladesoort...</h3>';
            };?>
            <div class="row">

                <?php
                foreach($categories as $cat){
                    if (!$cat_srch or $cat->getCategoryID() == ''){
                        if($cat->getParentCategory() != $cat_srch){
                            continue;
                        }
                    }
                    $attachment = $attachment->retrieve($cat->getAttachmentID());

                    echo '<form method="post" action="' . $this->root . '" >';
                        echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat->getCategoryID() . '">';
                        echo '<button name="srchCategory" type="submit" value="search category" class="categorybox col-md-2">';
                        echo '<div class="cat-title">' . $cat->getCategoryName() . '</div>';
                        echo '<img class="img-responsive img-fit" src="' . $attachment->getFileLocation() .'">';
                        echo '</button>';
                    echo '</form>';
                }
                    ?>
            </div>
        </div>

        <div id = "products" class="padding-top1em">
            <?php echo (!$cat_srch) ? '<h3>Onze producten</h3>' : '<h3>Producten</h3>'; ?>
            <div class="row">
                <?php
                //get products based on category, or all products if none category is chosen
                if(!$cat_srch){
                    $products = $product->retrieve();
                }else {
                    $products = $product->where('*', 'CategoryID', '=', $cat_parent->getCategoryID());
                }

                $one = false;

                foreach($products as $prod){
                    if($i < $prod_counter || $i > $prod_counter + 5){
                        $i++;
                        continue;
                    }else{
                        if ($i >=  $prod_counter + 6){
                            $last = true;
                        }
                    }
                    if($prod->getStockItemID() == ''){
                        continue;
                    }

                    if ($prod->getAttachmentID() != 0) {
                        $attachment = $attachment->retrieve($prod->getAttachmentID());
                    }else{
                        $attachment =  '';
                    }
                    $one = true;

                    echo '<form method="post" action="' . $this->root . '/productdetail" >';
                    echo '<input type="text" name="productID" style="display:none;" value="' . $prod->getStockItemID() . '">';
                    echo '<div class="productbox col-md-5">';
                    echo '<img class="img-responsive img-fit" src="' . ($attachment == '') ? '' : $attachment->getFileLocation() . '">';
                    echo '<button name="srchProduct" type="submit" value="search product" class="productButton">';
                    echo 'Bekijken';
                    echo '</button>';
                    echo $prod->getStockItemName();
                    echo $prod->getRecommendedRetailPrice();
                    echo '</div>';
                    echo '</form>';
                    $i++;
                }
                if (!$one){
                    echo 'Geen producten gevonden.';
                }
                ?>
            </div>

            <div id="navigator">
                <?php echo '<form method="post" action="' . $this->root . '">';
                echo '<input type="text" name="prodCounter" style="display:none;" value ="' . $prod_counter . '">';

                $catID='';
                if ($cat_srch){
                    $catID = $cat_parent->getCategoryID();
                }
                echo '<input type="text" name="categoryID" style="display:none;" value="' . $catID . '">';

                if($prod_counter - 5 > 0){
                    echo '<button type="submit" name="previous">Vorige..</button>';
                }

                if(count($products)<=6){
                    $last = true;
                }
                if(!$last) {
                    echo '<button type="submit" name="next">Volgende..</button>';
                }
                ?>
                </form>
            </div>
        </div>
    </div>
<?php
//include 'content/frontend/itemlist.php';
include_once 'content/frontend/footer.php';

?>