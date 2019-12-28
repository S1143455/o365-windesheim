<?php
include_once 'content/frontend/header.php';
include 'content/frontend/display_message.php';
// Check if the user is logged in.
if (!isset($_SESSION['authenticated']))
{
    echo display_message('info','U kunt deze handeling nu niet uitvoeren.<br>U wordt door gestuurd naar de hoofdpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
    die;
}

// Did the user press a button?
//echo "<pre>";print_r($_SESSION);echo "</pre>";
if (isset($_POST['removeaccount']))

{
    // The user wishes to stay...
    if (!$_POST['removeaccount']){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/onderhoudaccount\">";}
    // the user really wants to go.
    if ($_POST['removeaccount'])
    {
        // We now know that the users wants to delete all of his data.
        $customerId=$_SESSION['USER']['CUSTOMER_DETAILS'][0]['CustomerID'];
        $personId=$_SESSION['USER']['DATA'][0]['PersonID'];
        $handleDatabase=new \Model\Database();
        // Check if there's something to remove from the shopping cart.
        $cart=new \Model\ShoppingCart();
        $cleanCart=$cart->EmptyCart();
        // Remove the address
        $removeAddress=$handleDatabase->UpdateStmt("delete from address where personId=".$personId);
        // Remove customer details
        $removeCustomer=$handleDatabase->UpdateStmt("delete from customer where personId=".$personId);
        // Remove people details
        $removePeople=$handleDatabase->UpdateStmt("delete from people where personId=".$personId);
        // Empty the $_SESSION array
        session_unset();
        echo display_message('success','Uw gegevens zijn succesvol verwijderd.<br>U bent succesvol uitgelogd.<br>U keert zo terug naar de hoofdpagina.') . "<META HTTP-EQUIV=Refresh CONTENT=\"3;URL=/\">";
        die;
    }
}

?>
<div class="container">
    <div class="row">
        <form role="form" id="deleteaccount" method="POST" action="">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4><span class="glyphicon glyphicon-warning-sign"></span> Weet u echt zeker dat u uw account bij Oma's Beste wilt verwijderen?</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-success btn-block" name="removeaccount" value=0>
                                    Nee, ik wil mijn account niet verwijderen
                                </button><br>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-danger btn-block" name="removeaccount" value=1>
                                    Ja, ik wil mijn account verwijderen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

