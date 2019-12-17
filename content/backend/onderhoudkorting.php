<?php
include_once 'content/backend/header-admin.php';
?>
<div class="container" style="width:100%">
    <div class="row">

<?php
include_once 'content/backend/sidebar-admin.php';
?>

<script>
    function generateCode() {
        var x = document.getElementById("inputCode")
        x.value = Math.floor((Math.random() * 900000000) + 100000000);
    }
</script>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <!--dit gaat in header -->
                <p>
                    <br> Onderhoud Korting
                </p>
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search">
                <br>
            </div>
        </div>
        <div class="row">
            <table class="table table-fixed" >
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
    <!-- style="" voorbeeld  -->
    <div class="col-md-2">
        <div class="row">
                     <!-- https://getbootstrap.com/docs/4.0/components/modal/  -->
            <button type="button" class="first discountButton btn btn-primary" data-toggle="modal" data-target="#kortingEenmaal">
                Eenmalige korting
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#kortingProduct">
                Korting op product(en)
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#kortingCategorie">
                Korting op categorie(ën)
            </button>
            <button type="button" class="discountButton btn btn-primary" data-toggle="modal" data-target="#kortingMailen">
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
                    <h4 class="modal-title" id="kortingEenmaalLabel">Eenmalige korting aanmaken</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        Code:
                        <input type="text" class="inputCode" aria-label="inputCode" id="inputCode">
                        <button type="button" class="btn btn-outline-secondary" onclick="generateCode();">Genereer code</button>
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        Eenmalig
                        </label>
                    </div>
                    <div class="col-md-12">
                        Percentage:
                        <input style="margin: 5px 0px 0px 19px;" type="text" class="inputPercentage" aria-label="inputCode" id="inputCode"> %
                    </div>
                    <div class="col-md-12"
                        <form>
                            Begin periode:
                            <input style="margin: 5px 0px 15px 4px; text-align: center;line-height: 10px;" type="date" class="inputCode">
                            Einde periode:
                            <input style="margin: 5px 0px 15px 4px; text-align: center;line-height: 10px;" type="date" class="inputCode">
                        </form>
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
                    Code:
                    <input type="text" class="inputCode" aria-label="inputCode" id="inputCode">
                    <button type="button" class="btn btn-outline-secondary" onclick="generateCode();">Genereer code</button>
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Eenmalig
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        Omschrijving:
                        <input class="form-control" style="margin-left: 98px" id="exampleFormControlTextarea1" rows="1"></input>
                    </div>
                </div>
                <div class="col-md-12">
                    Percentage:
                    <input style="margin: 5px 0px 0px 19px;" type="text" class="inputPercentage" aria-label="inputCode" id="inputCode"> %
                </div>
                <div class="col-md-12"
                <form>
                    Begin periode:
                    <input style="margin: 5px 0px 15px 4px; text-align: center;line-height: 10px;" type="date" class="inputCode">
                    Einde periode:
                    <input style="margin: 5px 0px 15px 4px; text-align: center;line-height: 10px;" type="date" class="inputCode">
                </form>
            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary">Korting aanmaken</button>
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
                <button type="button" class="btn btn-primary">Kortingn aanmaken</button>
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
                <button type="button" class="btn btn-primary">Korting versturen</button>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include_once 'content/backend/footer-admin.php';

?>
