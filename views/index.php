<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';

$cat_srch = false;
$cat_to_srch = '';
$prod_srch = false;
$productsPerPage = 11;
$prod_counter = 1;
$last = false;
$i = 1;

//navigation
if(isset($_POST['previous'])){
    $cat_to_srch = $_POST['categoryID'];

    if($cat_to_srch != '') {
        $cat_srch = true;
    }

    $prod_counter = $_POST['prodCounter'] - $productsPerPage;
}

if(isset($_POST['next'])){
    $cat_to_srch = $_POST['categoryID'];

    if($cat_to_srch != '') {
        $cat_srch = true;
    }
    $prod_counter = $_POST['prodCounter'] + $productsPerPage;
}

//product search
if(isset($_POST['srchProduct'])){
    $prod_srch = true;
}

//category search
if(isset($_POST['srchCategory'])){
    $cat_srch = true;
    $cat_to_srch = $_POST['categoryID'];
    $prod_counter = 1;
}

//back from productDetail
if(isset($_POST['prdBack']) && (!$_POST['home'])){
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

//if category is searched, then load new category and categories belonging to searched category
if($cat_srch){
    $cat_parent = $category->retrieve($cat_to_srch);
    $categories = $category->where("*", "ParentCategory", "=", $cat_parent->getCategoryID());
}else{
    $cat_parent = '';
    $categories = $category->retrieve();
}

//reset product_counter
if ($prod_counter < 1){
    $prod_counter = 1;
}

?>
    <div>
        <?php
        //if category is searched, then show back button
        if($cat_srch){
            echo '<form method="post" action="'. $this->root . '" class="padding-top1em">';
            echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat_parent->getCategoryID() . '">';
            echo '<button name="back" type="submit">Terug</button>';
            echo '</form>';
        };?>

        <div id="adv" class="col-md-12 banner padding-top1em">
        <?php if ($cat_srch and $cat_parent->getCategoryID() != ''){echo '<h3>' . $cat_parent->getCategoryName() . '</h3>';}; ?>
        </div>

        <?php
        //if no category searched, then show content from homepage
        if (!$cat_srch){ ?>
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
                        if($cat->getParentCategory() != $cat_to_srch){
                            continue;
                        }
                    }

                    //show category boxes
                    echo '<div class="col-md-2">';
                        echo '<div class="categorybox">';
                            echo '<form method="post" action="' . $this->root . '" class="">';
                                echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat->getCategoryID() . '">';
                                echo '<button name="srchCategory" type="submit" value="search category">';
                                echo '<div class="cat-title">' . $cat->getCategoryName() . '</div>';
                                $this->showAttachment($cat->getAttachmentID(), false,'img-responsive cat-img');
                                echo '</button>';
                            echo '</form>';
                        echo '</div>';

                    echo '</div>';
                }
                    ?>
            </div>
        </div>
        <div id = "products" class="padding-top1em">
            <?php echo (!$cat_srch) ? '<h4>Onze producten</h4>' : '<h4>Producten</h4>'; ?>
            <div class="row">
                <?php
                //get products based on category, or all products if no category is chosen
                if(!$cat_srch){
                    $products = $product->retrieve();
                }else {
                    $products = $product->where('*', 'CategoryID', '=', $cat_parent->getCategoryID());
                }

                $one = false;

                foreach($products as $prod){

                    //check prod_counter for navigation to determine products to show on chosen page
                    if($i < $prod_counter || $i > $prod_counter + $productsPerPage){
                        $i++;
                        continue;
                    }

                    //if there ain't a description, don't show product
                    if($prod->getStockItemName() == ''){
                       continue;
                    }

                    $one = true;
                    echo '<div class="col-md-4 padding-bottom1em">';
                        echo '<div class="productbox">';

                            echo '<div class="imagebox">';
                            $this->showAttachment($prod->getAttachmentID(), false, 'img-responsive img-fit');
                            echo '</div>';

                            echo '<div class="productDetail">';
                                echo '<form method="post" action="' . $this->root . '/productdetail">';
                                echo '<input type="text" name="home" style="display:none;" value="' . (($cat_srch) ? false : true) . '">';
                                echo '<input type="text" name="productID" style="display:none;" value="' . $prod->getStockItemID() . '">';
                                echo '<b>' . $prod->getStockItemName() . '</b><br>';
                                echo '€' . $prod->getRecommendedRetailPrice();
                                    echo '<button name="srchProduct" type="submit" value="search product" class="productButton">';
                                    echo 'Bekijken';
                                    echo '</button>';
                                echo '<br>';
                                echo '</form>';
                            echo '</div>';

                        echo '</div>';
                    echo '</div>';
                    $i++;
                }
                if (!$one){
                    echo 'Geen producten gevonden.';
                }
                ?>
            </div>

            <!-- navigator buttons -->
            <div id="navigator">
                <?php echo '<form method="post" action="' . $this->root . '">';
                echo '<input type="text" name="prodCounter" style="display:none;" value ="' . $prod_counter . '">';
                echo '<input type="text" name="categoryID" style="display:none;" value="' . (($cat_srch) ? $cat_parent->getCategoryID() : '') . '">';

                if($prod_counter - $productsPerPage > 0){
                    echo '<button type="submit" name="previous">Vorige..</button>';
                }

                if((count($products) - $productsPerPage) > 12) {
                    echo '<button type="submit" name="next">Volgende..</button>';
                }
                ?>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
    </div>
<?php
//include 'content/frontend/itemlist.php';
include_once 'content/frontend/footer.php';

?>