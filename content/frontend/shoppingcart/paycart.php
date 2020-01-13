<?php
$bankenArray=['ABN AMRO','ASN Bank','Friesland Bank','ING','Rabobank','RegioBank','SNS Bank','Triodos Bank','Van Lanschot Bankiers',];
$monthArray=['01','02','03','04','05','06','07','08','09','10','11','12'];
?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="" style="width: 100%">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><span class="glyphicon glyphicon-euro"></span> Kies uw betaalmethode</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="product-name"><strong>Uw factuurbedrag is € <?php echo $_SESSION['USER']['SHOPPING_CART']['AMOUNT_TO_PAY']; ?>.</strong></h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="radio" id="idealpayment" name="paymentmethod" value="ideal"
                                    <?php
                                    if (!isset($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']))
                                    {
                                        echo "checked";
                                    }
                                    else
                                        if ($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']=='ideal'){echo "checked";}
                                    ?>><label for="idealpayment"><h5><strong> Ideal </strong></h5></label>
                            </div>
                            <div class="col-md-4">
                                <img src="content/frontend/shoppingcart/cartimages/ideal.png">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <h5><strong>Selecteer uw bank:</strong></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
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
                            <div class="col-md-4 text-left">
                                <input type="radio" class="form-check-input" id="creditcardpayment" name="paymentmethod" value="creditcard"
                                    <?php
                                    if (!isset($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD'])){echo "";}
                                    else
                                        if ($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']== 'creditcard'){echo "checked";}
                                    ?>
                                ><label for="creditcardpayment"><h5><strong> Credit card </strong></h5></label>
                            </div>
                            <div class="col-md-4">
                                <img src="content/frontend/shoppingcart/cartimages/creditcards.png" height="24" width="128">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <h5>Kaartnummer (*)</h5>
                            </div>
                            <div class="col-md-8 text-left">
                                <input type="text" class="form-control" name="CCNumber" id="CCNumber" value="" placeholder="Kaartnummer">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <h5>Naam Kaarthouder (*)</h5>
                            </div>
                            <div class="col-md-8 text-left">
                                <input type="text" class="form-control" name="CCName" id="CCName" value="" placeholder="Naam Kaarthouder">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <h5>Vervaldatum (*)</h5>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="form-group">
                                    <select  class="form-control" id="CCMonth" name="CCMonth">
                                        <?php
                                        foreach ($monthArray as $key)
                                        {
                                            echo '<option value="' . $key  . '">' .  $key . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 text-center">
                                <h5>/</h5>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="form-group">
                                    <select  class="form-control" id="CCYear" name="CCYear">
                                        <?php
                                        $year=date('Y');
                                        for ($y=$year; $y<=($year+10);$y++)
                                        {
                                            echo '<option value="' . $y  . '">' .  $y . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <h5>CVC/CVV/CID (*)</h5>
                            </div>
                            <div class="col-md-8 text-left">
                                <input type="text" class="form-control" name="CC_CVC" id="CC_CVC" value="" placeholder="CVC/CVV/CI">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <div class="form-group form-check">
                                    <input type="radio" class="form-check-input" id="afterpaypayment" name="paymentmethod" value="afterpay"
                                        <?php
                                        if (!isset($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD'])){echo "";}
                                        else
                                            if ($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']== 'afterpay'){echo "checked";}
                                        ?>
                                    ><label for="afterpaypayment"><h5><strong> AfterPay </strong></h5></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="content/frontend/shoppingcart/cartimages/afterpay.png" height="24" width="64">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block" name="checkaddress">
                                    <i class="fas fa-arrow-circle-left"></i> Terug naar adres controleren
                                </button>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block" name="handlepayment">
                                    Betaling afronden <i class="fas fa-arrow-circle-right"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
