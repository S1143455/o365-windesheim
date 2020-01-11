<?php
include_once 'content/backend/header-admin.php';

use Model\Customer;

if (isset($_POST['id'])) {
    $customerID = $_POST['id'];
    if ($customerID != 0) {
        $customer = $customerController->retrieve($customerID);

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
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search"
                       id="myInputCustomer">
                <br>

                <div class="row">
                    <div class="col-12 col-md-7 col-lg-10 tableViewCustomer">
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
                                        <th class="col-md-2">Nieuwsbrief</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyCustomer">
                                    <?php $customerController->getAllCustomer(); ?>
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
                            <div class="form-group col-4">
                                <div>
                                    <label class="control-label" for="orderid">Bestelnummer:</label>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="orderid" id="orderid">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="col-5 control-label">Nieuwsbrief:</label>
                                <input class="checkboxOneTime" type="checkbox" name="newsletter" id="newsletter"
                                       value="<?php echo($customer->getNewsletter()) ?>
                            </div>
                            <div class="col-12">
                                <button class="col-3 btn btn-outline-secondary" type="button">Wachtwoord resetten
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


    <!-- script to search data in edit tableViewCategory using the searchbar-->
    <script>
        $(document).ready(function () {
            $("#myInputCustomer").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tbodyCustomer tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

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