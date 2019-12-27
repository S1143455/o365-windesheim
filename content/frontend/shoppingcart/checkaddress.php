<?php
// The salutation in an array
$salutationarray=['MAN'=>'De heer','VROUW'=>'Mevrouw'];
$saluation=$salutationarray[strtoupper($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'])];

// The addresslines fro billing (and intial shipping)
$userName=$saluation . ' ' . $_SESSION['USER']['DATA'][0]['FullName'];
$addressLine1=$_SESSION['USER']['ADDRESS'][0]['Address'];
$addressLine2=$_SESSION['USER']['ADDRESS'][0]['Zipcode'] . ' ' .$_SESSION['USER']['ADDRESS'][0]['City'];
$billingaddress=$userName . '<br>' . $addressLine1 . '<br>' . $addressLine2;

?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-home"></span> Controleer uw adres</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="product-name"><strong>Uw factuuradres:</strong></h4>
                                <?php echo $billingaddress; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="checkbox" class="form-check-input" name="billing_eq_deliveryaddress" id="billing_eq_deliveryaddress" value="true" checked>
                                <label class="form-check-label" for="exampleCheck1">Het factuuradres is gelijk aan het afleveradres</label>
                                <br>
                                <h4><strong>Afleveradres:</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-3">
                                <b>Aanhef (*) </b>
                                <label for="male"> De heer </label>
                                <input type="radio" name="Gender" id="male" value="male" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                            </div>
                            <div class="form-group col-xs-5">
                                <label for="female">Mevrouw</label>
                                <input type="radio" name="Gender" id="female" value="female" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="FullName">Naam</label>
                                <input type="text" class="form-control" name="FullName" id="FullName" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Address" >Adres</label>
                                <input type="text" class="form-control" name="Address" id="Address" value= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Zipcode">Postcode</label>
                                <input type="text" class="form-control" name="Zipcode"  id="Zipcode" value="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="City">Woonplaats</label>
                                <input type="text" class="form-control" name="City" id="City" value="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block" name="backtocart">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Terug naar winkelwagen
                                </button>
                            </div>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block" name="paycart">
                                    Betaling afronden <span class="glyphicon glyphicon-arrow-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
