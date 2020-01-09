<?php
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

include_once 'content/backend/header-admin.php';
use Model\Order;
if (isset($_POST['id'])) {
    $OrderID = $_POST['id'];
    if($OrderID != 0){
        $order = $orderController->retrieve($OrderID);
        $customer = $orderController->retrieveCustomer($order->getCustomerID());
        $person = $orderController->retrievePeople($customer->getPersonID());
        $orderlines = $orderController->retrieveOrderLine($order->getOrderID());

        echo "<script type='text/javascript'> $(document).ready(function(){ $('#orderDetailsDialog').modal('show');   }); </script>";

    }
}

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
                    <th class="col-md-1">Details</th>
                    <th class="col-md-2">Bestel nummer</th>
                    <th class="col-md-3">Klant nummer</th>
                    <th class="col-md-3">Bestel datum</th>
                    <th class="col-md-3">Bedrag</th>
                </tr>
                </thead>
                <tbody>

                    <?php  $orderController->GetAllOrders(); ?>
                </tbody>
            </table>
        </form>

    </div>

    <div class="modal fade" id="orderDetailsDialog" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
        <div class="modal-dialog" style="width:1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Bestellingsoverzicht</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customerID">customer Name:  </label>
                        <p><?php echo $person->getFullName() ?></p>
                    </div>

                    <table id="OrderTable" class="table table-fixed">
                        <thead>
                            <tr>
                                <th class="col-md-4">omschrijving</th>
                                <th class="col-md-2">hoeveelheid</th>
                                <th class="col-md-2">belastings percentage</th>
                                <th class="col-md-2">prijs Excl btw</th>
                                <th class="col-md-2">prijs Incl btw</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orderlines as $orderline) {
                                $products = $orderController->retrievestockitemwhere($orderline->getStockItemID());
                                foreach ($products as $prod){
                                    $orderController->DisplayProduct($prod, $orderline );
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--                    <input type="submit" name="submit" value="Aanpassen" class="btn btn-primary">-->
                </div>
            </div>
        </div>
    </div>
<script>
    $("#orderDetailsDialog").on("hidden.bs.modal", function () {
        location.reload();
    });
    </script>




<?php

include_once 'content/backend/footer-admin.php';

?>