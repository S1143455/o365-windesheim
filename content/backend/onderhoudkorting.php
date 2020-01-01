<?php
include_once 'content/backend/header-admin.php';

if (isset($_POST['id'])) {
    $discountID = $_POST['id'];
    if ($discountID != 0) {
        $discountID = $discountController->retrieve($discountID);
        echo "<script type='text/javascript'> $(document).ready(function(){ $('#EditDiscountDialog').modal('show');   }); </script>";
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
                Onderhoud Korting
            </h3>
            <br>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?"
                   aria-label="Search"
                   id="myInput" onkeyup="searchbar()">
            <br>

            <div class="row">
                <div class="col-12 col-md-7 col-lg-8">
                    <!-- Creates a table with headers and data based on function -->
                    <table class="table table-responsive-lg table-bordered" id="tableViewDiscount">
                        <thead>
                        <tr>
                            <th class="">Manage</th>
                            <th class="">Code</th>
                            <th class="">Percentage</th>
                            <th class="">Eenmalig</th>
                            <th class="">Actief</th>
                            <th class="">Omschrijving</th>
                            <th class="">Product aantal</th>
                            <th class="">Beginperiode</th>
                            <th class="">Eindperiode</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $discount->GetAllDiscount(); ?>
                        </tbody>
                    </table>
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
<!-- modal (popup) eenmalige korting -->
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
                            <label class="control-label" for="inputCodeOT">Code:</label>
                            <input class="form-control inputCode" type="text" name="DealCode"
                                   id="inputCodeOT" placeholder="Code">
                            <button class="btn btn-outline-secondary" type="button"
                                    onclick="generateCodeOT();">Genereer code
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="checkboxOT">Eenmalig:</label>
                            <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT"
                                   value="1">
                        </div>
                        <div class="form-group">
                            <label class="labelInputPercentage" for="inputPercentageOT">Percentage:</label>
                            <input class="form-control inputPercentage" type="text" name="DiscountPercentage"
                                   id="inputPercentageOT">
                            <span class="symbolPercentage">%</span>
                        </div>
                        <div class="form-group">
                            <label class="labelInputStartDate" for="inputStartDateOT">Begin periode:</label>
                            <input class="form-control inputStartDate" type="date" name="StartDate"
                                   id="inputStartDateOT">
                        </div>
                        <div class="form-group">
                            <label for="inputEndDateOT">Einde periode:</label>
                            <input class="form-control inputEndDate" type="date" name="EndDate"
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
                                    <table class="table table-fixed tableCollapseSP"
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
                                        <?php $discount->GetAllProducts(); ?>
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
                        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeDP();">
                            Genereer
                            code
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
                    <button type="submit" class="btn btn-primary" name="submit">Korting aanmaken</button>
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
                                        <?php $discount->GetAllCategories(); ?>
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

<!-- modal to change selected row -->
<div class="modal fade" id="EditDiscountDialog" tabindex="-1" role="dialog" aria-labelledby="EditModal"
     aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <form role="form" id="CreateDiscount" method="POST" action="CreateDiscount">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="checkboxMD">Eenmalig:</label>
                        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxMD"
                               value="<?php echo($discount->getDealCode()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Eenmalig</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getOneTime()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getLastEditedBy()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName"
                               value="<?php echo($discount->getParentCategory()) ?>">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                    </div>
                    <div class="form-group">
                        <label for="categoryID">Categorie</label>
                        <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                    </div>

                    <p>some content</p>
                    <input style="" type="text" name="bookId" id="bookId" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" value="Aanmaken" class="btn btn-primary">
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
        $('#createCategory').modal('show');
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
        $('#createCategory').modal('show');
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
        $('#createCategory').modal('show');
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
