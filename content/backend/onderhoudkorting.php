<?php
include_once 'content/backend/header-admin.php';
use Model\Discount;

if (isset($_POST['id'])) {
    $discountID = $_POST['id'];
    if ($discountID != 0) {
        $discount = $discountController->retrieve($discountID);
        $discount->getSpecialDealID();
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditDiscountDialog').modal('show');   }); </script>";
    }

}

//echo "***********<br>"; print_r($_POST); echo "<br>***********<br>";
//
//
//$invalues='';
//
//while ( ($myname=current($_POST['StockItemID'])) !==FALSE ){
//    $invalues=$invalues.','.key($_POST['StockItemID']);
//    next($_POST['StockItemID']);
//
//}
//$invalues=substr($invalues,1);
//echo "***********<br>".$invalues."<br>***********<br>";
//
//$sql="update " . $_POST['submit'] . " set y = z where id in (".$invalues. ")";
//echo $sql."<br>";


?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">

        <?php
        include_once 'content/backend/sidebar-admin.php';
        ?>

        <div class="col-12 col-md-9 col-lg-10">
            <!--dit gaat in header -->
            <h3>
                Onderhoud Korting
            </h3>
            <br>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?"
                   aria-label="Search"
                   id="myInput" onkeyup="searchbar()">
            <br>

            <div class="row">
                <div class="col-12 col-md-7 col-lg-8 tableDiscount">
                    <!-- Creates a table with headers and data based on function -->
                    <form role="form" id="table" method="POST" action="">

                        <table class="table table-responsive-lg table-bordered" id="tableViewDiscount">
                            <thead>
                            <tr>
                                <th class="col-md-1">Manage</th>
                                <th class="col-md-2">Code</th>
                                <th class="col-md-1">Percentage</th>
                                <th class="col-md-1">Eenmalig</th>
                                <th class="col-md-1">Actief</th>
                                <th class="col-md-3">Omschrijving</th>
                                <th class="col-md-1">Product aantal</th>
                                <th class="col-md-1">Beginperiode</th>
                                <th class="col-md-1">Eindperiode</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $discountController->GetAllDiscount(); ?>
                            </tbody>
                        </table>
                    </form>
                </div>

                <!-- style="" -->

                <div class="col-12 col-md-2 col-lg-2 discountButtons">
                    <!-- discount option buttons  -->
                    <button type="button" class="discountButton btn btn-primary" data-toggle="modal"
                            data-target="#oneTimeDiscount">
                        Eenmalige korting
                    </button>
                    <button type="button" class="discountButton btn btn-primary" data-toggle="modal"
                            data-target="#DiscountProduct">
                        Korting op product(en)
                    </button>
                    <button type="button" class="discountButton btn btn-primary" data-toggle="modal"
                            data-target="#DiscountCategory">
                        Korting op categorie(ën)
                    </button>
                    <button type="button" class="discountButton btn btn-primary" data-toggle="modal"
                            data-target="#MailDiscount">
                        Korting mailen naar klant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal (popup) oneTimeDiscount -->
<div class="modal fade" id="oneTimeDiscount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Eenmalige korting aanmaken</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-3 ml-xs-3 control-label" for="inputCodeOT">Code:</label>
                            <input class="col-4 form-control inputCode" type="text" name="DealCode"
                                   id="inputCodeOT" placeholder="Code">
                            <button class="col-4 btn btn-outline-secondary btnGenerateCode" type="button"
                                    onclick="generateCodeOT();">Genereer code
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-md-3 col-lg-3 control-label" for="checkboxOT">Eenmalig:</label>
                            <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT"
                                   value="1">
                        </div>
                        <div class="form-group">
                            <label class="col-3 control-label" for="inputPercentageOT">Percentage:</label>
                            <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                                   id="inputPercentageOT">
                            <span class="col-1 symbolPercentage">%</span>
                        </div>
                        <div class="form-group">
                            <label class="col-3 control-label" for="inputStartDateOT">Begin periode:</label>
                            <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                                   id="inputStartDateOT">
                        </div>
                        <div class="form-group">
                            <label class="col-3 control-label" for="inputEndDateOT">Einde periode:</label>
                            <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                                   id="inputEndDateOT">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting op product -->
<div class="modal fade" id="DiscountProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting op product(en)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseProduct"
                           role="button"
                           aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                    </p>
                    <div class="tableCollapseProduct">
                        <div class="collapse multi-collapse" id="tableCollapseProduct">
                            <div class="card card-body">
                                <div class="row">
                                    <input class="form-control collapseTableSearch" type="text"
                                           placeholder="Waar ben je naar op zoek?"
                                           aria-label="Search" id="myInputProduct"
                                           onkeyup="searchbarProduct()">
                                </div>
                                <div class="col-12">
                                    <table class="table table-responsive-lg tableCollapseSP"
                                           id="tableCollapseProduct">
                                        <thead>
                                        <tr>
                                            <th class="col-md-2">Select</th>
                                            <th class="col-md-2">Productnr</th>
                                            <th class="col-md-3">Productnaam</th>
                                            <th class="col-md-1">Prijs</th>
                                            <th class="col-md-4">Opmerkingen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $discountController->GetAllProducts(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputCodePD">Code:</label>
                        <input type="text" class="form-control inputCode" name="DealCode" id="inputCodeDP"
                               placeholder="Code">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="generateCodeDP();">Genereer code
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="checkboxDP">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxDP">
                    </div>
                    <div class="form-group">
                        <label class="control-label descriptionPopUp" for="descriptionDP">Omschrijving:</label>
                        <textarea class="form-control dealDescription" name="DealDescription"
                                  id="descriptionDP" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputPercentage"
                               for="inputPercentageDP">Percentage:</label>
                        <input type="text" class="form-control inputPercentage" name="DiscountPercentage"
                               id="inputPercentageDP">
                        <span class="symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputStartDate" for="inputStartDateDP">Begin
                            periode:</label>
                        <input type="date" class="form-control inputStartDate" name="StartDate"
                               id="inputStartDateDP">
                    </div>
                    <div class="form-group">
                        <label for="control-label inputEndDateDP">Einde periode:</label>
                        <input type="date" class="form-control inputEndDate" name="EndDate"
                               id="inputEndDateDP">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="deze tael">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting op categorie -->
<div class="modal fade" id="DiscountCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting op categorie(ën)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse"
                           href="#tableCollapseCategory"
                           role="button"
                           aria-expanded="false" aria-controls="tableCollapseCategory">Categorie zoeken</a>
                    </p>
                    <div class="tableCollapseCategory">
                        <div class="collapse multi-collapse" id="tableCollapseCategory">
                            <div class="card card-body">
                                <div class="row">
                                    <input class="form-control collapseTableSearch" type="text"
                                           placeholder="Waar ben je naar op zoek?"
                                           aria-label="Search" id="myInputCategory"
                                           onkeyup="searchbarCategory()">
                                    <table class="table table-fixed tableCollapseSC"
                                           id="tableCollapseCategory">
                                        <thead>
                                        <tr>
                                            <th class="col-md-2">Select</th>
                                            <th class="col-md-2">Categorie nr</th>
                                            <th class="col-md-4">Categorie naam</th>
                                            <th class="col-md-4">Parent Categorie</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $discountController->GetAllCategories(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputCodeDC">Code:</label>
                        <input type="text" class="form-control inputCode" name="DealCode" id="inputCodeDC"
                               placeholder="Code">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="generateCodeDC();">Genereer code
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="control-label descriptionPopUp" for="descriptionDC">Omschrijving:</label>
                        <textarea class="form-control dealDescription" name="DealDescription"
                                  id="descriptionDC" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputPercentage"
                               for="inputPercentageDC">Percentage:</label>
                        <input type="text" class="form-control inputPercentage" name="DiscountPercentage"
                               id="inputPercentageDC">
                        <span class="symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputStartDate" for="inputStartDateDC">Begin
                            periode:</label>
                        <input type="date" class="form-control inputStartDate" name="StartDate"
                               id="inputStartDateDC">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputEndDateDC">Einde periode:</label>
                        <input type="date" class="form-control inputEndDate" name="EndDate"
                               id="inputEndDateDC">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal (popup) korting mailen naar klant -->
<div class="modal fade" id="MailDiscount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="universalModalForm" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting mailen naar klant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="inputFullName">Eenmalig:</label>
                        <input class="form-control" type="text" name="inputFullName" id="inputFullName">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputEmailCustomer">Code:</label>
                        <input type="email" class="form-control inputEmailCustomer" name="EmailCustomer" id="EmailCustomer"
                               placeholder="Code">
                    </div>
                    <div class="form-group">
                        <label class="control-label descriptionPopUp" for="descriptionMD">Omschrijving:</label>
                        <textarea class="form-control dealDescription" name="DealDescription"
                                  id="descriptionMD" rows="3" placeholder="Omschrijving"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputPercentage"
                               for="inputPercentageMD">Percentage:</label>
                        <input type="text" class="form-control inputPercentage" name="DiscountPercentage"
                               id="inputPercentageMD">
                        <span class="symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label labelInputStartDate" for="inputPercentageMD">Begin
                            periode:</label>
                        <input type="date" class="form-control inputStartDate" name="StartDate"
                               id="inputPercentageMD">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputEndDateMD">Einde periode:</label>
                        <input type="date" class="form-control inputEndDate" name="EndDate"
                               id="inputEndDateMD">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputEmail">Email:</label>
                        <input type="email" class="form-control inputEmail" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal to edit selected table row in a modal -->
<div class="modal fade" id="EditDiscountDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="EditDiscount" method="POST" action="UpdateDiscount">
                <div class="modal-header">
                    <h4 class="modal-title">Korting aanpassen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo($discountController->stockitems($discount)) ?>
                    <div class="form-group" style="display: none;">
                        <label class="col-3" for="SpecialDealID">SpecialDealID:</label>
                        <input type="text" class="form-control" name="SpecialDealID" id="SpecialDealID"
                               value="<?php echo($discount->getSpecialDealID()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-3" for="DealCode">Code:</label>
                        <input type="text" class="form-control" name="DealCode" id="DealCode"
                               value="<?php echo($discount->getDealCode()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-3 control-label" for="checkboxOT">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT"
                               value="<?php echo($discount->getOneTime())?>
                    </div>
                    <div class="form-group">
                        <label class="col-3" for="categoryID">Omschrijving:</label>
                        <textarea class="form-control dealDescription" name="DealDescription" id="DealDescription"
                               value="<?php echo($discount->getDealDescription()) ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-3 control-label" for="inputPercentageOT">Percentage:</label>
                        <input class="col-2 form-control inputPercentage" type="text" name="DiscountPercentage"
                               id="inputPercentageOT"
                               value="<?php echo($discount->getDiscountPercentage()) ?>">
                        <span class="col-1 symbolPercentage">%</span>
                    </div>
                    <div class="form-group">
                        <label class="col-3 control-label" for="inputStartDateOT">Begin periode:</label>
                        <input class="col-4 form-control inputStartDate" type="date" name="StartDate"
                               id="inputStartDateOT"
                               value="<?php echo($discount->getStartDate()) ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-3 control-label" for="inputEndDateOT">Einde periode:</label>
                        <input class="col-4 form-control inputEndDate" type="date" name="EndDate"
                               id="inputEndDateOT"
                               value="<?php echo($discount->getEndDate()) ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <input type="submit" name="submit" value="Korting aanpassen" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>



<!-- scripts to generate a random code for each modal-->
<script xmlns:line-height="http://www.w3.org/1999/xhtml">
    function generateCodeOT() {
        var x = document.getElementById("inputCodeOT")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeDP() {
        var x = document.getElementById("inputCodeDP")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeDC() {
        var x = document.getElementById("inputCodeDC")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeMD() {
        var x = document.getElementById("inputCodeMD")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }
</script>

<!-- scripts for searchbar in each modal-->
<script>
    $('.load-modal').on('click', function (e) {
        e.preventDefault();
        $('#createDiscount').modal('show');
    });

    function searchbar() {
        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableViewDiscount");
        tr = table.getElementsByTagName("tr");
        if (filter == '') {
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for (x = 0; x < tds.length; x++) {
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if (tdsearch == false) {
                tr[i].style.display = "none";
            }
        }
    }
</script>

<script>
    $('.load-modal').on('click', function (e) {
        e.preventDefault();
        $('#createDiscount').modal('show');
    });

    function searchbarProduct() {
        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInputProduct");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableCollapseProduct");
        tr = table.getElementsByTagName("tr");
        if (filter == '') {
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }
        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for (x = 0; x < tds.length; x++) {
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if (tdsearch == false) {
                tr[i].style.display = "none";
            }
        }
    }
</script>

<script>
    $('.load-modal').on('click', function (e) {
        e.preventDefault();
        $('#createDiscount').modal('show');
    });

    function searchbarCategory() {
        var input, filter, tale, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInputCategory");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableCollapseCategory");
        tr = table.getElementsByTagName("tr");
        if (filter == '') {
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for (x = 0; x < tds.length; x++) {
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if (tdsearch == false) {
                tr[i].style.display = "none";
            }
        }
    }
</script>

<?php
include_once 'content/backend/footer-admin.php';

?>
