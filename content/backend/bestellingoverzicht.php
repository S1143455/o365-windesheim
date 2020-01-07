<?php

include_once 'content/backend/header-admin.php';
use Model\Order;
if (isset($_POST['id'])) {
    $OrderID = $_POST['id'];
    if($OrderID != 0){
        $order = $orderController->retrieve($OrderID);
        $customer = $orderController->retrieveCustomer($order->getCustomerID());
        $person = $orderController->retrievePeople($customer->getPersonID());
        $orderstockitems = $orderController->retrieveOrderstockitem($order->getOrderID());
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#orderDetailsDialog').modal('show');   }); </script>";
    }
}

?>

<div class="container" style="width:100%">
    <div class="row">
<?php
//    include_once 'content/backend/sidebar-admin.php';
//?>

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

    <div class="modal fade" id="orderDetailsDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
        <div class="modal-dialog" style="width:1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                        <label for="categoryID">customer Name:  </label>
                        <p><?php echo $person->getFullName() ?></p>
<!--                        klant, person, stockitem,order,orderstockitem,, mogelijk ook special deal  -->
<!--                        <input type="text" class="form-control" name="CategoryID" id="CategoryID" value="--><?php //echo($category->getCategoryID()) ?><!--" >-->
                    </div>

                    <table id="OrderTable" class="table table-fixed">
                        <thead>
                        <tr>
                            <th class="col-md-3">edit</th>
                            <th class="col-md-3">Klant nummer</th>
                            <th class="col-md-3">Bestel datum</th>
                            <th class="col-md-3">Bedrag</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($orderstockitems as $orderstockitem) {
                            $products = $orderController->retrievestockitem($orderstockitem->getStockitemID());
                            foreach ($products as $prod){
                                $orderController->DisplayProduct($prod, $orderstockitem );
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<!--                    <input type="submit" name="submit" value="Aanpassen" class="btn btn-primary">-->
                </div>
            </div>
        </div>
    </div>




<?php

include_once 'content/backend/footer-admin.php';

?>