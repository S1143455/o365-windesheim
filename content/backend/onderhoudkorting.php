<?php

include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-">
            <!--dit gaat in header -->
            <p>
                Onderhoud Korting
            </p>
            <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
            <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
        </div>
    </div>

    <div class="container">
        <table class="table table-fixed">
            <thead>
            <tr>
                <th class="col-xs-1">Code</th>
                <th class="col-xs-1">Percentage</th>
                <th class="col-xs-1">Eenmalig</th>
                <th class="col-xs-1">Gebruikt</th>
                <th class="col-xs-2">Omschrijving</th>
                <th class="col-xs-2">Productnummer</th>
                <th class="col-xs-2">Productcode</th>
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
                <h5 class="modal-title" id="kortingEenmaalLabel">Eenmalige korting aanmaken</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Eenmalige korting aanmaken</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Wijziging(en) opslaan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kortingProduct" tabindex="-1" role="dialog" aria-labelledby="kortingProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kortingProductLabel">Korting op product(en) aanmaken</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Korting op product(en) aanmaken</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Wijziging(en) opslaan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kortingCategorie" tabindex="-1" role="dialog" aria-labelledby="kortingCategorieLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kortingCategorieLabel">Korting op een categorie(ën) aanmaken</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Korting op categorie(ën) aanmaken</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Wijziging(en) opslaan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kortingMailen" tabindex="-1" role="dialog" aria-labelledby="kortingMailenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kortingMailenLabel">Korting mailen naar klant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Korting mailen naar klant</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Wijziging(en) opslaan</button>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'content/backend/footer-admin.php';

?>
