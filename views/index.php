<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';

$cat_srch = false;

if(isset($_POST['srchCategory'])){
    $cat_srch = true;
    $cat_to_srch = $_POST['categoryID'];
}

if(isset($_POST['back'])){
    $cat_to_srch = $category->retrieve($_POST['categoryID'])->getParentCategory();
    if ($cat_to_srch != ''){
        $cat_srch = true;
    }
};

if($cat_srch){
    $cat_parent = $category->retrieve($cat_to_srch);
    $categories = $category->where("*", "ParentCategory", "=", $cat_parent->getCategoryID());
}else{
    $cat_parent = '';
    $categories = $category->retrieve();
}
?>
    <div>
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

        <div id="categories" class="padding-top3em">
            <?php if(!$cat_srch){
                echo '<h3>Kies je lekkerste chocoladesoort...</h3>';
            }else{
                echo '<form method="post" action="'. $this->root . '" >';
                echo '<input type="text" name="categoryID" style="display:none;" value="' . $cat_parent->getCategoryID() . '">';
                echo '<button name="back" type="submit">Terug</button>';
                echo '</form>';
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

        <div id = "products">

        </div>
    </div>
<?php
//include 'content/frontend/itemlist.php';
include_once 'content/frontend/footer.php';

?>