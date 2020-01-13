<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';

// Retry the payment.
if (isset($_POST['RetryPayment']))
{
    $_SESSION['USER']['SHOPPING_CART']['PAYMENT']='retry';
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/" . getenv('ROOT') . "winkelwagen\">";
}

if (isset($_POST['DifferentMethod']))
{
    $_SESSION['USER']['SHOPPING_CART']['PAYMENT']='method';
    echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/" . getenv('ROOT') . "winkelwagen\">";
}

?>
<div class="container">
    <div class="row">
        <form role="form" id="table" method="POST" action="">
            <div class="col-xs-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4><span class="glyphicon glyphicon-thumbs-down"></span> Uw betaling is mislukt!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4><strong>Helaas is uw betaling mislukt.</strong></h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-success btn-block" name="DifferentMethod">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Andere betaalmethode
                                </button>
                            </div>
                            <div class="col-xs-6">
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-success btn-block" name="RetryPayment">
                                    Opnieuw proberen <span class="glyphicon glyphicon-retweet"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
