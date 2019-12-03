<?php

include_once 'content/backend/header-admin.php';
include_once 'content/backend/sidebar-admin.php';
?>

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
        <!-- style="" voorbeeld  -->

        <div class="row" style="min-height: 1000px">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <!-- https://getbootstrap.com/docs/4.0/components/modal/  -->
                <button type="button" class="kortingopproductButton btn btn-primary" data-toggle="modal" data-target="#kortingProduct">
                    Korting op product(en)
                </button>
                <button type="button" class="eenmaligekortingButton btn btn-primary" data-toggle="modal" data-target="#kortingEenmaal">
                    eenmalige korting aanmaken
                </button>
                <button type="button" class="kortingopcategorieButton btn btn-primary" data-toggle="modal" data-target="#kortingCategorie">
                    Korting op categorie(ën) aanmaken
                </button>
                <button type="button" class="kortingmailenButton btn btn-primary" data-toggle="modal" data-target="#kortingMailen">
                    Korting mailen naar klant
                </button>

            </div>
        </div>
    </div>
    <div class="modal fade" id="kortingEenmaal" tabindex="-1" role="dialog" aria-labelledby="kortingEenmaalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kortingEenmaalLabel">Korting aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Eenmalige korting aanmaken</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kortingProduct" tabindex="-1" role="dialog" aria-labelledby="kortingProductLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kortingProductLabel">Korting aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Eenmalige korting aanmaken</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kortingCategorie" tabindex="-1" role="dialog" aria-labelledby="kortingCategorieLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kortingCategorieLabel">Korting aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Eenmalige korting aanmaken</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kortingMailen" tabindex="-1" role="dialog" aria-labelledby="kortingMailenLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kortingMailenLabel">Korting aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Eenmalige korting aanmaken</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<?php
include_once 'content/backend/footer-admin.php';


?>

<?php

include_once 'content/backend/footer-admin.php';

?>