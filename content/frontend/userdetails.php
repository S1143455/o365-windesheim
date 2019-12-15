<html lang="NL">
    <head>
        <body>
            <h2>Uw klant nummer is <?php echo $_SESSION['USER']['DATA'][0]['PersonID']; ?>.</h2>
            <h2>Hieronder staan de gegevens zoals deze bij ons bekend zijn.</h2>
                <?php if (isset($_POST['changeuser'])){include "update_userdetails.php";}?>
                <div class="card">
                    <article class="card-body">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <b>Aanhef</b>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="male">De heer</label>
                                    <input type="radio" disabled name="Gender" id="male" value="<?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo 'true';} ?>" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="female">Mevrouw</label>
                                    <input type="radio" disabled name="Gender" id="female" value="<?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo 'true';} ?>" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label for="naam">Naam</label>
                                    <input type="text" readonly class="form-control" name="Naam" id="FullName" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="dob">Geboortedatum</label>
                                    <input type="text" readonly class="form-control" name="Naam" id="DateOfBirth" value="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Address" >Adres</label>
                                    <input type="text" readonly class="form-control" name="Address" id="Address" placeholder= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="Zipcode">Postcode</label>
                                    <input type="text" readonly class="form-control" name="Zipcode"  id="Zipcode" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Woonplaats</label>
                                    <input type="text" readonly class="form-control" name="city" id="city" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="EmailAddress">Emailadres</label>
                                    <input type="text" readonly class="form-control" id="EmailAddress" name="EmailAddress" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="LogonName">Inlognaam</label>
                                    <input type="text" readonly class="form-control" id="LogonName" name="LogonName" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['LogonName'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Beste.</label>
                                    <input type="checkbox" disabled name="newsletter" id="newsletter" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                                </div>
                            </div>
                        </form>
                    </article>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changeuser">Gegevens aanpassen</button>
                        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changepassword">Wachtwoord aanpassen</button>
                    </div>
                </div>

                <div class="modal fade" id="changeuser" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:1000px;">
                        <div class="modal-content">
                            <form role="form" id="universalModalForm" method="POST" action="">
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
                                            <label for="address" >Adres</label>
                                            <input type="text" class="form-control" name="address" id="address" value= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Zipcode">Postcode</label>
                                            <input type="text" class="form-control" name="Zipcode"  id="Zipcode" value="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="City">Woonplaats</label>
                                            <input type="text" class="form-control" name="city" id="City" value="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
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
                                            <input type="checkbox" name="newsletter" id="newsletter" value="<?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo 1;} ?>" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                                            <input type="hidden" name="PersonID" value="<?php echo $_SESSION['USER']['DATA'][0]['PersonID'];?>" >
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

                <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:1000px;">
                        <div class="modal-content">
                            <form role="form" id="universalModalForm" method="POST" action="say_hi.php">
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
                                        <input type="password" class="form-control" name="oldpw" id="oldpw">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpw1">Uw nieuwe wachtwoord</label>
                                        <input type="password" class="form-control" name="newpw1" id="newpw1">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpw2">Herhaal uw nieuwe wachtwoord</label>
                                        <input type="password" class="form-control" name="newpw2" id="newpw2">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                    <input type="submit" name="submit" value="Opslaan" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </body>
    </head>
</html>