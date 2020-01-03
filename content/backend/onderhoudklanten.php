<?php
include_once 'content/backend/header-admin.php';

?>
<div class="container" style="width:100%" xmlns="http://www.w3.org/1999/html">
    <div class="row">

<?php
include_once 'content/backend/sidebar-admin.php';
?>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <!--dit gaat in header -->
                <h3>
                    <br> Onderhoud Klanten
                </h3>
                <!-- geen idee hoe dit werkt heb gegoogled naar bootstrap search -->
                <input class="form-control" type="text" placeholder="Waar ben je naar op zoek?" aria-label="Search" id="myInput" onkeyup="searchbar()">
                <br>
            </div>
        </div>
        <div class="row">
            <table class="table table-fixed" id="tableViewCustomer">
                <thead>
                <tr>
                    <th class="col-xs-2">Klantnummer</th>
                    <th class="col-xs-2">Email</th>
                    <th class="col-xs-2">Naam</th>
                    <th class="col-xs-1">Aangemaakt</th>
                    <th class="col-xs-2">Laatste login</th>
                    <th class="col-xs-2">Laatste bestelling</th>
                    <th class="col-xs-1">Nieuwsbrief</th>
                </tr>
                </thead>
                <tbody>
                <?php $discount->GetAllDiscount(); ?>
                </tbody>
            </table>
        </div>