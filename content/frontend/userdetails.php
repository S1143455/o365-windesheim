<HTML lang="NL">
    <HEAD>
        <BODY>
            <h2>Uw klant nummer is <?php echo $_SESSION['USER']['DATA'][0]['PersonID']; ?>.<h2></h2>
            <h2>Hieronder staan de gegevens zoals deze bij ons bekend zijn.</h2>
                <div class="card">
                    <article class="card-body">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <b>Aanhef</b>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="male">De heer</label>
                                    <input type="radio" disabled name="male" id="male" value="male" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="female">Mevrouw</label>
                                    <input type="radio" disabled name="female" id="aanhef" value="female" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label for="naam">Naam</label>
                                    <input type="text" readonly class="form-control" name="Naam" id="naam" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="dob">Geboortedatum</label>
                                    <input type="text" readonly class="form-control" name="Naam" id="dob" value="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address" >Adres</label>
                                    <input type="text" readonly class="form-control" name="address" id="address" placeholder= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zipcode">Postcode</label>
                                    <input type="text" readonly class="form-control" name="zipcode"  id="zipcode" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Woonplaats</label>
                                    <input type="text" readonly class="form-control" name="city" id="city" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Emailadres</label>
                                    <input type="text" readonly class="form-control" name="email" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Beste.</label>
                                    <input type="checkbox" disabled name="newsletter" id="newsletter" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                                </div>
                            </div>
                        </form>
                    </article>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changeuser">
                            Gegevens aanpassen
                        </button>
                        <button type="button" class="firstdiscountButton btn btn-primary" data-toggle="modal" data-target="#changepassword">
                            Wachtwoord aanpassen
                        </button>

                    </div>
                </div>

                <div class="modal fade" id="changeuser" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:1000px;">
                        <div class="modal-content">
                            <form role="form" id="universalModalForm" method="POST" action="say_hi.php">
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
                                            <input type="radio" name="male" id="male" value="male" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label for="female">Mevrouw</label>
                                            <input type="radio" name="female" id="aanhef" value="female" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label for="naam">Naam</label>
                                            <input type="text" class="form-control" name="Naam" id="naam" value="<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="dob">Geboortedatum</label>
                                            <input type="text" class="form-control" name="Naam" id="dob" value="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="address" >Adres</label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="zipcode">Postcode</label>
                                            <input type="text" class="form-control" name="zipcode"  id="zipcode" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="city">Woonplaats</label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="email">Emailadres</label>
                                            <input type="text" class="form-control" name="email" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="newsletter">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Beste.</label>
                                            <input type="checkbox" name="newsletter" id="newsletter" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                                        </div>
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
        </BODY>
    </HEAD>
</HTML>
<?php //echo "<pre>";print_r($_SESSION['USER']);echo "</pre><br>";?>