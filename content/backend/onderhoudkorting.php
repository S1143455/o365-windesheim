<?php
include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';

?>

<div class="container" style="width:100%" xmlns="http://www.w3.org/1999/html">
    <div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <!--dit gaat in header -->
                <h3>
                    <br> Onderhoud Korting
                </h3>
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search" id="myInput" onkeyup="searchbar()">
                <br>
            </div>
        </div>
        <div class="row">
            <table class="table table-fixed" id="tableViewDiscount">
                <thead>
                <tr>
                    <th class="col-md-2">Code</th>
                    <th class="col-md-1">Percentage</th>
                    <th class="col-md-1">Eenmalig</th>
                    <th class="col-md-1">Gebruikt</th>
                    <th class="col-md-3">Omschrijving</th>
                    <th class="col-md-2">Product aantal</th>
                    <th class="col-md-1">Beginperiode</th>
                    <th class="col-md-1">Eindperiode</th>
                </tr>
                </thead>
                <tbody>
                <?php $discount->GetAllDiscount(); ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- style="" -->
    <div class="col-md-2">
        <div class="row">

            <!-- discount option buttons  -->
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#oneTimeDiscount">
                Eenmalige korting
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#DiscountProduct">
                Korting op product(en)
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#DiscountCategory">
                Korting op categorie(ën)
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#MailDiscount">
                Korting mailen naar klant
            </button>
        </div>
    </div>
</div>


<!-- modal (popup) eenmalige korting -->
<div class="modal fade" id="oneTimeDiscount" tabindex="-1" role="dialog" aria-labelledby="oneTimeDiscount" aria-hidden="true">
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
                <div class="form-group">
                    <label for="inputCodeOT">Code:</label>
                    <input type="text" class="form-control inputCode" name="DealCode" id="inputCodeOT">
                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeOT();">Genereer code</button>
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="checkboxOT">Eenmalig:</label>
                    <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT">
                </div>
                <div class="form-group">
                    <label class="labelInputPercentage" for="inputPercentageOT">Percentage:</label>
                    <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageOT" id="inputPercentageOT">
                    <span class="symbolPercentage">%</span>
                </div>
                <div class="form-group">
                    <label class="labelInputStartDate" for="inputStartDateOT">Begin periode:</label>
                    <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateOT">
                </div>
                <div class="form-group">
                    <label for="inputEndDateOT">Einde periode:</label>
                    <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateOT">
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
<div class="modal fade" id="DiscountProduct" tabindex="-1" role="dialog" aria-labelledby="DiscountProduct" aria-hidden="true">
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
                    <a class="btn btn-secondary collapseButton" data-toggle="collapse" href="#tableCollapseProduct" role="button"
                       aria-expanded="false" aria-controls="tableCollapse">Product zoeken</a>
                </p>
                <div class="form-group">
                    <div class="collapse multi-collapse" id="tableCollapseProduct">
                        <div class="card card-body">
                            <div class="row">
                                <input class="form-control collapseTableSearch" type="text" placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputProduct" onkeyup="searchbarProduct()">
                                <table class="table table-fixed tableCollapseSP" id="tableViewProduct">
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
                    <label for="inputCodePD">Code:</label>
                    <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodePD" id="inputCodeDP">
                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeDP();">Genereer code</button>
                </div>
                <div class="form-group">
                    <label for="checkboxDP">Eenmalig:</label>
                    <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxDP">
                </div>
                <div class="form-group">
                    <label class="descriptionPopUp" for="descriptionDP">Omschrijving:</label>
                    <textarea class="form-control dealDescription" name="DealDescription" id="descriptionDP" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="labelInputPercentage" for="inputPercentageDP">Percentage:</label>
                    <input type="text" class="form-control inputPercentage" aria-label="inputPercentageDP" name="DiscountPercentage" id="inputPercentageDP">
                    <span class="symbolPercentage">%</span>
                </div>
                <div class="form-group">
                    <label class="labelInputStartDate" for="inputStartDateDP">Begin periode:</label>
                    <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateDP">
                </div>
                <div class="form-group">
                    <label for="inputEndDateDP">Einde periode:</label>
                    <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateDP">
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
<div class="modal fade" id="DiscountCategory" tabindex="-1" role="dialog" aria-labelledby="DiscountCategory" aria-hidden="true">
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
                        <a class="btn btn-secondary collapseButton" data-toggle="collapse" href="#tableCollapseCategory" role="button"
                           aria-expanded="false" aria-controls="tableCollapseCategory">Categorie zoeken</a>
                    </p>
                    <div class="form-group">
                    <div class="collapse multi-collapse" id="tableCollapseCategory">
                        <div class="card card-body">
                            <div class="row">
                                <input class="form-control collapseTableSearch" type="text" placeholder="Waar ben je naar op zoek?"
                                       aria-label="Search" id="myInputCategory" onkeyup="searchbarCategory()">
                                <table class="table table-fixed tableCollapseSC" id="tableViewCategory">
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
                    <label for="inputCodeDC">Code:</label>
                    <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodeDC" id="inputCodeDC">
                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeDC();">Genereer code</button>
                </div>
                <div class="form-group">
                    <label class="descriptionPopUp" for="descriptionDC">Omschrijving:</label>
                    <textarea class="form-control dealDescription" name="DealDescription" id="descriptionDC" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="labelInputPercentage" for="inputPercentageDC">Percentage:</label>
                    <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageDC" id="inputPercentageDC">
                    <span class="symbolPercentage">%</span>
                </div>
                <div class="form-group">
                    <label class="labelInputStartDate" for="inputStartDateDC">Begin periode:</label>
                    <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateDC">
                </div>
                <div class="form-group">
                    <label for="inputEndDateDC">Einde periode:</label>
                    <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateDC">
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
<div class="modal fade" id="MailDiscount" tabindex="-1" role="dialog" aria-labelledby="MailDiscount" aria-hidden="true">
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
                    <label for="inputCodeMD">Code:</label>
                    <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodeMD" id="inputCodeMD">
                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeMD();">Genereer code</button>
                </div>
                <div class="form-group">
                    <label for="checkboxMD">Eenmalig:</label>
                    <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxMD">
                </div>
                <div class="form-group">
                    <label class="descriptionPopUp" for="descriptionMD">Omschrijving:</label>
                    <textarea class="form-control dealDescription" name="DealDescription" id="descriptionMD" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="labelInputPercentage" for="inputPercentageMD">Percentage:</label>
                    <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageMD" id="inputPercentageMD">
                    <span class="symbolPercentage">%</span>
                </div>
                <div class="form-group">
                    <label class="labelInputStartDate" for="inputPercentageMD">Begin periode:</label>
                    <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartMD">
                </div>
                <div class="form-group">
                    <label for="inputEndDateMD">Einde periode:</label>
                    <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateMD">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email:</label>
                    <input type="email" class="form-control inputEmail" id="inputEmail">
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
</div>

<!-- scripts voor het geneneren van random kortingscodes -->
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

<!-- scripts voor het zoeken naar resultaten in de zoekbalk-->
<script>
    $('.load-modal').on('click', function(e){
        e.preventDefault();
        $('#createCategory').modal('show');
    });

    function searchbar() {

        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableViewDiscount");
        tr = table.getElementsByTagName("tr");

        if(filter == ''){
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for(x = 0; x < tds.length; x++){
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if(tdsearch == false){
                tr[i].style.display = "none";
            }
        }
    }
</script>

<script>
    $('.load-modal').on('click', function(e){
        e.preventDefault();
        $('#createCategory').modal('show');
    });

    function searchbarProduct() {

        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInputProduct");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableViewProduct");
        tr = table.getElementsByTagName("tr");

        if(filter == ''){
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for(x = 0; x < tds.length; x++){
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if(tdsearch == false){
                tr[i].style.display = "none";
            }
        }
    }
</script>

<script>
    $('.load-modal').on('click', function(e){
        e.preventDefault();
        $('#createCategory').modal('show');
    });

    function searchbarCategory() {

        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("myInputCategory");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableViewCategory");
        tr = table.getElementsByTagName("tr");

        if(filter == ''){
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }

        for (i = 1; i < tr.length; i++) {
            tdsearch = false;
            tds = tr[i].getElementsByTagName("td");
            for(x = 0; x < tds.length; x++){
                if (tds[x]) {
                    txtValue = tds[x].textContent || tds[x].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tdsearch = true;
                    }
                }
            }
            if(tdsearch == false){
                tr[i].style.display = "none";
            }
        }
    }
</script>

<?php
include_once 'content/backend/footer-admin.php';

?>
