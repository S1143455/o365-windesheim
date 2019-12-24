<?php

include_once 'content/backend/header-admin.php';
use Model\Order;
?>
<<<<<<< HEAD

<div class="container" style="width:100%">
    <div class="row">
<?php
    include_once 'content/backend/sidebar-admin.php';
?>

<div class="col-md-8">
    <div class="row" style="min-height: 50px;"></div>
    <div class="row" style="min-height: 50px;">
        <div class="col-md-7">
            <input class="form-control" id="myInput" onkeyup="searchbar()" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
        </div>

    </div>
    <div class="col-md-6">
        <table id="categoryTable" class="table table-fixed">
            <thead>
            <tr>
                <th class="col-md-3">Bestel nummer</th>
                <th class="col-md-3">Klant nummer</th>
                <th class="col-md-3">Bestel datum</th>
                <th class="col-md-3">Bedrag</th>
            </tr>
            </thead>
            <tbody>
                <?php $orderController->GetAllOrders(); ?>
            </tbody>
        </table>
=======
    <div class="container">
        <form action="upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    Bestellingoverzicht
    <p>This is <b>home</b>
        page.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
>>>>>>> 0e65300749d33f7f6d34dc60ac7692f570658799
    </div>




<?php

include_once 'content/backend/footer-admin.php';

?>