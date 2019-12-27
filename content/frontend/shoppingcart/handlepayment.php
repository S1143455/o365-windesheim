<?php
// Handles the payment.
if (!isset($_POST['paymentmethod'])){$_POST['paymentmethod']=$_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD'];}

if (strlen($_POST['paymentmethod'])>1)
{
    $_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']=$_POST['paymentmethod'];
}

// The easiest payment is Afterpay. This payment will always result in a success.
if ($_SESSION['USER']['SHOPPING_CART']['PAYMENT_METHOD']=='afterpay'){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/betalengelukt\">";die;}

// If the payment is by bank or by CreditCard you can choose the payment result.
if (isset($_POST['paymentresult']))
{
    if ($_POST['paymentresult']=='success')
    {
        echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/betalengelukt\">";

    }
    else
    {
        echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/betalenmislukt\">";
    }
}

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
                                    <h4><span class="glyphicon glyphicon-euro"></span> Selecteer het resultaat van de betaling</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="radio" id="paymentsucces" name="paymentresult" value="success"><label for="paymentsucces"><h4 > Gelukt </h4></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 text-left">
                                <input type="radio" id="paymentfail" name="paymentresult" value="fail"><label for="paymentfail"><h4 > Mislukt </h4></label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-success btn-block" name="paymentmethod">
                                    Doorgaan <span class="glyphicon glyphicon-arrow-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>







