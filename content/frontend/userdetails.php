<?php
// Check ik the user wants to remove his account
if (isset($_POST['removeaccount'])){echo "<META HTTP-EQUIV=Refresh CONTENT=\"0;URL=/accountverwijderen\">";}
?>

<html lang="NL">
    <head>
    </head>
    <body>
        <h2>Uw klant nummer is <?php echo $_SESSION['USER']['DATA'][0]['PersonID']; ?>.</h2>
        <h2>Hieronder staan de gegevens zoals deze bij ons bekend zijn.</h2>
            <?php
            if (isset($_POST['changeuser']))
            {
                include "update_userdetails.php";
            }
            elseif (isset($_POST['changepassword']))
            {
                include "update_userpassword.php";
                $changepassword=update_UserPassword($_POST['oldpw'],$_POST['newpw1']);
                if ($changepassword['hasfaild']==true)
                {
                    echo display_message('danger', $changepassword['message']) . "<meta http-equiv='refresh' content='3'>";
                }
                else
                {
                    echo display_message('success', $changepassword['message']) . "<meta http-equiv='refresh' content='3'>";
                }

            }
            ?>
        <script type="text/javascript">
            function ValidatePassword()
            {
                let firstInput = document.getElementById("newpw1").value;
                let secondInput = document.getElementById("newpw2").value;
                if (firstInput === secondInput) {
                    return true;
                } else {
                    $('#error_message').show();
                    return false;
                }
            }
        </script>
    <!-- Show the the data of the logged in user. -->
            <div class="card">
                <article class="card-body">
                    <form method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <b>Aanhef</b>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="male0">De heer</label>
                                <input type="radio" disabled id="male0" value="<?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo 'true';} ?>" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="female0">Mevrouw</label>
                                <input type="radio" disabled id="female0" value="<?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo 'true';} ?>" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="naam0">Naam</label>
                                <input type="text" readonly class="form-control" id="FullName0" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="dob">Geboortedatum</label>
                                <input type="text" readonly class="form-control" id="DateOfBirth0" value="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Address0" >Adres</label>
                                <input type="text" readonly class="form-control" id="Address0" placeholder= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Zipcode0">Postcode</label>
                                <input type="text" readonly class="form-control" id="Zipcode0" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city0">Woonplaats</label>
                                <input type="text" readonly class="form-control" id="city0" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="EmailAddress0">Emailadres</label>
                                <input type="text" readonly class="form-control" id="EmailAddress0" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="LogonNam0e">Inlognaam</label>
                                <input type="text" readonly class="form-control" id="LogonName0" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['LogonName'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="newsletter0">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Beste.</label>
                                <input type="checkbox" disabled id="newsletter0" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                            </div>
                        </div>
                    </form>
                </article>
            </div>
    <!-- The two buttons. -->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changeuser">Gegevens aanpassen</button>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changepassword">Wachtwoord aanpassen</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><br></div>
            </div>
            <div class="row">
                <div class="col-md-12"><br></div>
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteaccount">Account verwijderen</button>
                </div>
            </div>
        </div>

    <!-- The form for changing user details. -->
            <div class="modal fade" id="changeuser" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:1000px;">
                    <div class="modal-content">
                        <form role="form" id="changeuserForm" method="POST" action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                                <h4 class="modal-title"><span class="modal-title">Aanpassen gegevens</span></h4>
                            </div>
                            <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                                <span class="alert-body"></span>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <b>Aanhef</b>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="male">De heer</label>
                                        <input type="radio" name="Gender" id="male" value="male" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="female">Mevrouw</label>
                                        <input type="radio" name="Gender" id="female" value="female" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="FullName">Naam</label>
                                        <input type="text" class="form-control" name="FullName" id="FullName" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="DateOfBirth">Geboortedatum</label>
                                        <input type="text" class="form-control" name="DateOfBirth" id="DateOfBirth" value="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>">
                                    </div>
                                </div>
                                <div class="form-row">
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
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="EmailAddress">Emailadres</label>
                                        <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" value="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="LogonName">Inlognaam</label>
                                        <input type="text" class="form-control" id="LogonName" name="LogonName" value="<?php echo $_SESSION['USER']['DATA'][0]['LogonName'];?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Beste.</label>
                                        <input type="checkbox" name="newsletter" id="newsletter" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                                        <input type="hidden" name="PersonID" value="<?php echo $_SESSION['USER']['DATA'][0]['PersonID'];?>">
                                        <input type="hidden" name="AddressId" value="<?php echo $_SESSION['USER']['ADDRESS'][0]['AddressId'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                <input type="submit" name="changeuser" value="Opslaan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    <!-- The form for changing the password. -->
            <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:1000px;">
                    <div class="modal-content">
                        <form role="form" id="changepasswordForm" method="POST" action="" onsubmit="return ValidatePassword()">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Close</span></button>
                                <h4 class="modal-title"><span class="modal-title">Wachtwoord wijzigen</span></h4>
                            </div>
                            <div class="alert alert-danger fade in" id="universalModal-alert" style="display: none;">
                                <span class="alert-body"></span>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="oldpw">Uw oude wachtwoord</label>
                                    <input type="password" class="form-control" name="oldpw" id="oldpw" required>
                                </div>
                                <div class="form-group">
                                    <label for="newpw1">Uw nieuwe wachtwoord</label>
                                    <input type="password" class="form-control" name="newpw1" id="newpw1" required>
                                </div>
                                <div class="form-group">
                                    <label for="newpw2">Herhaal uw nieuwe wachtwoord</label>
                                    <input type="password" class="form-control" name="newpw2" id="newpw2" required>
                                </div>
                                <div id="error_message" style="display:none" class="alert alert-danger" role="alert">
                                    <h4 >De wachtwoorden komen niet overeen.</h4>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                <input type="submit" name="changepassword" value="Opslaan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <!-- The form for deleting the entire account -->
        <div class="modal fade container" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
            <div class="row">
                <form role="form" id="deleteaccount" method="POST" action="">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h4><span class="glyphicon glyphicon-warning-sign"></span> Account verwijderen</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4><strong>Weet u zeker dat u uw account bij Oma's Beste wilt verwijderen?</strong></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4><strong>Als u uw account heeft verwijderd, is er geen mogelijkheid om deze te herstellen!</strong></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row text-center">
                                    <div class="col-xs-12">
                                        <button type="button" class="btn btn-success btn-block" data-dismiss="modal">
                                            Nee, ik wil mijn account niet verwijderen
                                        </button><br>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-danger btn-block" name="removeaccount" value="true">
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
    </body>
</html>