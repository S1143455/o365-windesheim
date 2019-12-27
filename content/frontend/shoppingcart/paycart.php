<?php
print_r($_POST);
//echo "<pre>";print_r($_SESSION['USER']['SHOPPING_CART']);echo "<br></pre>";
$bankenArray=['ABN AMRO','ASN Bank','Friesland Bank','ING','Rabobank','RegioBank','SNS Bank','Triodos Bank','Van Lanschot Bankiers',];
//echo "<pre>";print_r($_SESSION['USER']);echo "<br></pre>";

$userName=$_SESSION['USER']['DATA'][0]['FullName'];
$addressLine1=$_SESSION['USER']['ADDRESS'][0]['Address'];
$addressLine2=$_SESSION['USER']['ADDRESS'][0]['Zipcode'] . ' ' .$_SESSION['USER']['ADDRESS'][0]['City'];;

// Let's remeber the paymentmethod for now.
if (isset($_POST['paymentmethod']))
{
    $_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']=$_POST['paymentmethod'];
}

?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-euro"></span> Afrekenen</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 class="product-name"><strong>Uw factuurbedrag is € <?php echo $_SESSION['USER']['SHOPPING_CART']['AMOUNT_TO_PAY']; ?>.</strong></h4>
                                <h4 class="text-left">Kies uw betaalmethode:</h4>
                            </div>
                            <div class="col-xs-6">
                                <h4 class="text-left">Kies uw betaal methode:</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="radio" id="idealpayment" name="paymentmethod" value="idealpayment"
                                    <?php
                                    if (!isset($_POST['paymentmethod']))
                                    {
                                        echo "checked";
                                    }
                                    else
                                        if ($_POST['paymentmethod']=='idealpayment'){echo "checked";}
                                    ?>><label for="idealpayment"><h4 > Ideal </h4></label>
                            </div>
                            <div class="col-xs-4">
                                <img src="content/frontend/shoppingcart/cartimages/ideal.png">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-left">
                                <h4>Selecteer uw bank:</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div class="form-group">
                                    <select class="form-control" id="selectbank" name="selectbank">
                                        <?php
                                        foreach ($bankenArray as $item)
                                        {
                                            echo "<option>" . $item. "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-4 text-left">
                                <input type="radio" class="form-check-input" id="creditcardpayment" name="paymentmethod" value="creditcardpayment"
                                    <?php
                                    if (!isset($_POST['paymentmethod'])){echo "";}
                                    else
                                        if ($_POST['paymentmethod']== 'creditcardpayment'){echo "checked";}
                                    ?>
                                ><label for="creditcardpayment"><h4 > Credit card </h4></label>
                            </div>
                            <div class="col-xs-4">
                                <img src="content/frontend/shoppingcart/cartimages/creditcards.png" height="24" width="128">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-4 text-left">
                                <div class="form-group form-check">
                                    <input type="radio" class="form-check-input" id="afterpaypayment" name="paymentmethod" value="afterpaypayment"
                                        <?php
                                        if (!isset($_POST['paymentmethod'])){echo "";}
                                        else
                                            if ($_POST['paymentmethod']== 'afterpaypayment'){echo "checked";}
                                        ?>
                                    ><label for="afterpaypayment"><h4 > AfterPay </h4></label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <img src="content/frontend/shoppingcart/cartimages/afterpay.png" height="24" width="64">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="text-center">
                                <div class="col-xs-12">
                                    <h4 class="text-right">Totaal <strong></strong></h4>
                                </div>
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
