<?php

include_once 'loader.php';
include_once 'content/frontend/header.php';

$pathHomePage = 'views/homePage/';
$pathHomeIsset = $pathHomePage.'isset/';
include_once($pathHomePage.'varInitHomepage.php');
include_once($pathHomeIsset.'previous.php');
include_once($pathHomeIsset.'next.php');
include_once($pathHomeIsset.'prdBack.php');
include_once($pathHomeIsset.'back.php');
include_once($pathHomeIsset.'srchProduct.php');
include_once($pathHomeIsset.'srchCategory.php');
include_once($pathHomeIsset.'prdBack.php');
include_once($pathHomeIsset.'back.php');
include_once($pathHomePage.'varSetHomepage.php');
?>
    <div class="">
        <div class="imgHome">
            <!-- plaatje -->
        </div>

        <?php include_once($pathHomePage.'homeStory.php'); ?>

        <div id="categories" class="container categories">
            <?php include_once($pathHomePage.'categoryBoxesHeader.php'); ?>

            <div id="categoryBoxes" class="row padding-top1em">
                <?php include_once ($pathHomePage.'categoryBoxes.php'); ?>
            </div>

        </div>

        <?php include_once ($pathHomePage.'productBoxesHeader.php'); ?>

        <div class="row">
            <?php include_once($pathHomePage.'productBoxes.php'); ?>
        </div>

        <!-- navigator buttons -->
        <div class="navigator">
            <?php include_once($pathHomePage.'navigator.php'); ?>
        </div>
    </div>
    </div>
    </div>
</div>
    </div>

<?php include_once 'content/frontend/footer.php'; ?>