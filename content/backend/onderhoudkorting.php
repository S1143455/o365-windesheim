<?php

include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';

?>

<script xmlns:line-height="http://www.w3.org/1999/xhtml">
    function generateCodeOnetime() {
        var x = document.getElementById("inputCodeOneTime")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeProduct() {
        var x = document.getElementById("inputCodeDiscountProduct")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeCategory() {
        var x = document.getElementById("inputCodeDiscountCategory")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }

    function generateCodeMail() {
        var x = document.getElementById("inputCodeMailDiscount")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }
</script>

<script>
    $('.load-modal').on('click', function(e){
        e.preventDefault();
        $('#createCategory').modal('show');
    });

    function searchbar() {

        var input, filter, table, tr, tds, i, txtValue, tdsearch;
        input = document.getElementById("searchbarDiscount");
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
<div class="container">
    <div class="row">
        <div class="col-md-">
            <!--dit gaat in header -->
            <p>
                <br> Onderhoud Korting
            </p>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" id="searchbarDiscount" onkeyup="searchbar()" placeholder="Waar ben je naar op zoek?" aria-label="Search">
            <br>
        </div>
    </div>

    <div class="container">
        <table class="table table-fixed" id="tableViewDiscount">
            <thead>
            <tr>
                <th class="col-xs-2">Code</th>
                <th class="col-xs-1">Percentage</th>
                <th class="col-xs-1">Eenmalig</th>
                <th class="col-xs-1">Gebruikt</th>
                <th class="col-xs-3">Omschrijving</th>
                <th class="col-xs-2">Product aantal</th>
                <th class="col-xs-1">Beginperiode</th>
                <th class="col-xs-1">Eindperiode</th>
            </tr>
            </thead>
            <tbody>
            <?php $discount->GetAllDiscount(); ?>
            </tbody>
        </table>
    </div>
    <!-- style="" voorbeeld  -->

    <div class="row" style="min-height: 1000px">
        <div class="col-md-7">

        </div>
        <div class="col-md-5">
            <!-- https://getbootstrap.com/docs/4.0/components/modal/  -->
            <button type="button" class="one-offdiscountButton btn btn-primary" data-toggle="modal" data-target="#kortingEenmaal">
                Eenmalige korting
            </button>
            <button type="button" class="productdiscountButton btn btn-primary" data-toggle="modal" data-target="#kortingProduct">
                Korting op product(en)
            </button>
            <button type="button" class="categorydiscountButton btn btn-primary" data-toggle="modal" data-target="#kortingCategorie">
                Korting op categorie(ën)
            </button>
            <button type="button" class="maildiscountButton btn btn-primary" data-toggle="modal" data-target="#kortingMailen">
                Korting mailen naar klant
            </button>
        </div>
    </div>
</div>


<!-- modals (popups) -->
<div class="modal fade" id="kortingEenmaal" tabindex="-1" role="dialog" aria-labelledby="kortingEenmaalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="labelOneTimeDiscount">Eenmalige korting aanmaken</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="inputCodeOneTimeDiscount">Code:</label>
                        <input type="text" class="inputCode" aria-label="inputCodeOneTimeDiscount" id="inputCodeOneTimeDiscount">

                        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeOnetime();">Genereer code</button>

                        <input class="form-check-input" type="checkbox" value="" name="checkboxOneTimeDiscount" id="checkboxOneTimeDiscount">
                        <label class="form-check-label" for="checkboxOneTimeDiscount">Eenmalig</label>
                    </div>
                    <div class="col-md-12">
                        <label for="inputPercentageOneTimeDiscount">Percentage:</label>
                        <input type="text" class="inputPercentage" aria-label="inputPercentageOneTimeDiscount" id="inputPercentageOneTimeDiscount"> <span class="input-group-text">%</span>
                    </div>
                    <div class="col-md-12"
                    <div>
                        <label for="inputPercentageOneTimeDiscount">Begin periode:</label>
                        <input type="date" class="inputStartDate" id="inputStartDateOneTimeDiscount">

                        <div class="inputEndDate-container"
                        <p class="einde-periode">Einde periode:</p>
                        <input type="date" class="inputEndDate" id="inputEndDateOneTimeDiscount">
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="button" class="btn btn-primary" name="createDiscount">Korting aanmaken</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="kortingProduct" tabindex="-1" role="dialog" aria-labelledby="kortingProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="kortingEenmaalLabel">Korting op product(en) aanmaken</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="inputCodeProductDiscount">Code:</label>
                    <input type="text" class="inputCode" aria-label="inputCodeProductDiscount" id="inputCodeProductDiscount">

                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeProduct();">Genereer code</button>

                    <input class="form-check-input" type="checkbox" value="" id="checkboxDiscountProduct">
                    <label class="form-check-label" for="checkboxDiscountProduct">Eenmalig</label>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="descriptionPopUp" for="descriptionDiscountProduct">Omschrijving:</label>
                        <textarea class="form-control" id="descriptionDiscountProduct" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputPercentageDiscountProduct">Percentage:</label>
                    <input type="text" class="inputPercentage" aria-label="inputPercentageDiscountProduct" id="inputPercentageDiscountProduct"> <span class="input-group-text">%</span>
                </div>
                <div class="col-md-12">
                    <div>
                    <label for="inputPercentageDiscountProduct">Begin periode:</label>
                    <input type="date" class="inputStartDate" id="inputStartDateDiscountProduct">

                    <div class="inputEndDate-container">
                    <p class="einde-periode">Einde periode:</p>
                    <input type="date" class="inputEndDate" id="inputEndDateDiscountProduct">
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Korting aanmaken</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="kortingCategorie" tabindex="-1" role="dialog" aria-labelledby="kortingCategorieLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="kortingEenmaalLabel">Korting op categorie(ën) aanmaken</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="inputCodeCategoryDiscount">Code:</label>
                    <input type="text" class="inputCode" aria-label="inputCodeCategoryDiscount" id="inputCodeCategoryDiscount">

                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeCategory();">Genereer code</button>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    <label class="descriptionPopUp" for="descriptionDiscountProduct">Omschrijving:</label>
                    <textarea class="form-control" id="descriptionDiscountProduct" rows="3"></textarea>
                </div>
                </div>
                <div class="col-md-12">
                    <label for="inputPercentageDiscountCategory">Percentage:</label>
                    <input type="text" class="inputPercentage" aria-label="inputPercentageDiscountCategory" id="inputPercentageDiscountCategory"> <span class="input-group-text">%</span>
                </div>
                <div class="col-md-12">
                <div>
                    <label for="inputPercentageDiscountCategory">Begin periode:</label>
                    <input type="date" class="inputStartDate" id="inputStartDateDiscountCategory">

                    <div class="inputEndDate-container">
                    <p class="einde-periode">Einde periode:</p>
                    <input type="date" class="inputEndDate" id="inputEndDateDiscountCategory">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
            <button type="button" class="btn btn-primary">Korting aanmaken</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kortingMailen" tabindex="-1" role="dialog" aria-labelledby="kortingMailenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="kortingEenmaalLabel">Korting mailen naar klant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="inputCodeMailDiscount">Code:</label>
                    <input type="text" class="inputCode" aria-label="inputCodeMailDiscount" id="inputCodeMailDiscount">

                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodeMail();">Genereer code</button>
                    <input class="form-check-input" type="checkbox" value="" id="checkboxMailDiscount">
                    <label class="form-check-label" for="checkboxMailDiscount">Eenmalig</label>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="descriptionPopUp" for="descriptionMailDiscount">Omschrijving:</label>
                        <textarea class="form-control" id="descriptionMailDiscount" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputPercentageMailDiscount">Percentage:</label>
                    <input type="text" class="inputPercentage" aria-label="inputPercentageMailDiscount" id="inputPercentageMailDiscount"> <span class="input-group-text">%</span>
                </div>
                <div class="col-md-12"
                <div>
                    <label for="inputPercentageMailDiscount">Begin periode:</label>
                    <input type="date" class="inputStartDate" id="inputStartDateMailDiscount">

                    <div class="inputEndDate-container"
                    <p class="einde-periode">Einde periode:</p>
                    <input type="date" class="inputEndDate" id="inputEndDateMailDiscount">
                    </div>
                </div>
                <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                        <input type="email" class="form-control" id="inputEmail3">
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Korting mailen</button>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'content/backend/footer-admin.php';

?>
