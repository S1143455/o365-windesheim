<?php

include_once 'content/backend/header-admin.php';
use Model\Order;
?>

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
        <form role="form" id="table" method="POST" action="">

            <table id="OrderTable" class="table table-fixed">
                <thead>
                <tr>
                    <th class="col-md-1">edit</th>
                    <th class="col-md-2">Bestel nummer</th>
                    <th class="col-md-3">Klant nummer</th>
                    <th class="col-md-3">Bestel datum</th>
                    <th class="col-md-3">Bedrag</th>
                </tr>
                </thead>
                <tbody>
                    <?php $orderController->GetAllOrders(); ?>
                </tbody>
            </table>
        </form>

    </div>




<?php

include_once 'content/backend/footer-admin.php';

?>