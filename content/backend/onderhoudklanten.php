<?php
include_once 'content/backend/header-admin.php';
include 'content/backend/display_message.php';
include 'loader.php';

use Model\Customer;

if(isset($_POST['sendpassword'])) {
    include "content/frontend/sendemailaddress.php";
}

if(empty($_POST)){
    $customers = $customerController->getallcustomers();
}
if(!empty($_POST['name'])){
    $customers = $customerController->SearchCustomers($_POST['name']);
}
if (isset($_POST['id'])) {
    $customerID = $_POST['id'];
    if ($customerID != 0) {
        $customer = $customerController->retrieve($customerID);
        var_dump($customer->getCustomerID());
        $orders = $customerController->retrieveOrder($customer->getCustomerID());

        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditCustomerDialog').modal('show');   }); </script>";
    }

}
?>
    <div class="container-fluid">
        <div class="row">

            <?php
            include_once 'content/backend/sidebar-admin.php';
            ?>

            <div class="col-12 col-md-9 col-lg-10">
                <!--dit gaat in header -->
                <h3>
                    Onderhoud Klanten
                </h3>
                <form  method="post" action=""  id="searchform">
                    <input  type="text" name="name">
                    <input  type="submit" name="submit" value="Search">
                </form>
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <br>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-10 tableViewCustomer">
                        <!-- Creates a table with headers and data based on function -->
                        <form role="form" id="table" method="POST" action="">
                            <div class="table-fixed">
                                <table class="table table-bordered" id="tableViewCustomer">
                                    <thead>
                                    <tr>
                                        <th class="col-md-1">Manage</th>
                                        <th class="col-md-2">Klantnummer</th>
                                        <th class="col-md-3">Email</th>
                                        <th class="col-md-3">Naam</th>
                                        <th class="col-md-2">Laatste bestelling</th>
                                        <th class="col-md-1">Nieuwsbrief</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyCustomer">
                                    <?php $customerController->getAllCustomer($customers); ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal to edit selected table row in a modal -->
    <div class="modal fade" id="EditCustomerDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form role="form" id="EditCustomer" method="POST" action="UpdateCustomer">
                    <div class="modal-header">
                        <h4 class="modal-title">Klant details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group col-12">
                                <label class="col-5" for="CustomerID">Klant gegevens van klantnummer:</label>
                                <span class="col-4" id="CustomerID"
                                      style="padding-left: 0px;"><?php echo($customer->getCustomerID()) ?>
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5" for="FullName">Volledige naam:</label>
                                <input class="col-7 form-control" type="text" name="FullName" id="FullName"
                                       value="<?php echo($customer->getFullNameOnID($customerID)) ?>">
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5" for="DateOfBirth">Geboortedatum:</label>
                                <input class="col-3 form-control" type="date" name="DateOfBirth" id="DateOfBirth"
                                       value="<?php echo($customer->getDateOfBirthOnID($customerID)) ?>">
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5 control-label" for="Adress">Straat:</label>
                                <input class="col-7 form-control" type="text" name="Adress" id="Adress"
                                       value="<?php echo($customer->getAddressOnID($customerID)) ?>">
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5 control-label" for="Zipcode">Postcode:</label>
                                <input class="col-2 form-control" type="text" name="Zipcode" id="Zipcode"
                                       value="<?php echo($customer->getZipCodeOnID($customerID)) ?>">
                            </div>
                            <div class=" form-group col-12">
                                <label class="col-5" for="City">Woonplaats:</label>
                                <input class="col-7 form-control" name="City" id="City"
                                       value="<?php echo($customer->getCityOnID($customerID)) ?>">
                            </div>
                            <div class=" form-group col-12">
                                <label class="col-5" for="EmailAddress">Email:</label>
                                <input class="col-7 form-control" name="EmailAddress" id="EmailAddress"
                                       value="<?php echo($customer->getEmailAddressOnID($customerID)) ?>">
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5 control-label">Nieuwsbrief:</label>
                                <input class="checkboxOneTime" type="checkbox" name="newsletter" id="newsletter"
                                       value="<?php echo($customer->getNewsletter()) ?>
                            </div>
                            <?php if(!empty($orders) && $orders[0] != null && $orders[0]->getOrderID() != null){
                                foreach($orders as $order){
                                    echo '<div class="container">
                                              <div class="row">
                                                <div class="form-group col-md-12">
                                                  <label class="col-md-4" for="orderid">Bestelnummer:</label>
                                                  <label class="col-md-4" for="orderdate">Besteldatum:</label>
                                                  <label class="col-md-4" for="orderamount">Bedrag:</label>
                                                </div>
                                              </div>
                                            <div class="row">
                                              <div class="form-group col-md-12">
                                                  <span class="col-md-4" id="orderid"><a href="schoolproject_wwi/admin/bestellingoverzicht"> '. $order->getOrderID() .'</span></a>
                                                  <span class="col-md-4" id="orderdate">'. $order->getOrderDate() .'</span>
                                                  <span class="col-md-4" id="orderamount">'. $order->getOrderDate() .'</span>
                                              </div>
                                            </div>
                                          </div>
                                    ';
                                    }
                                } else {
                                echo '<div class="form-group col-12">
                                        <label class="col-5 control-label" for="orderid">Bestelnummer:</label>
                                        <span class="col-7" style="padding-left: 0px">Deze klant heeft geen bestelling gedaan</span>
                                      </div>';
                            }
                            ?>
                            <div class="form-group col-12">
                                <button class="col-3 btn btn-outline-secondary" type="button" data-toggle="modal"
                                        data-target="#sendpassword">Wachtwoord resetten
                                </button>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                        <input type="submit" name="submit" value="Klant aanpassen" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- form for resending password -->
    <div class="modal fade" id="sendpassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="width:1000px;">
            <div class="modal-content">
                <form role="form" id="sendpasswordform" method="POST" action="" onsubmit="return ValidatePassword()">
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="modal-title">Wachtwoord opvragen</span></h4>
                        <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                    </div>
                    <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                        <span class="alert-body"></span>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-5" for="LogonName">Gebruikersnaam:</label>
                            <input type="text" class="col-7 form-control" name="LogonName"
                                   value="<?php echo($customer->getFullNameOnID($customerID)) ?>" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-5" for="EmailAddress">Emailadres:</label>
                            <input type="email" class="col-7 form-control" name="EmailAddress" id="EmailAddress"
                                   value="<?php echo($customer->getEmailAddressOnID($customerID)) ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                        <input type="submit" name="sendpassword" value="Versturen" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- scripts for searchbar in each modal-->
    <script>
        $(document).ready(function () {
            $("#id").click(function () {
                $("#EditCustomerDialog").modal();
            });
        });
    </script>

<?php
include_once 'content/backend/footer-admin.php';

?>