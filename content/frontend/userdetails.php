<HTML lang="NL">
    <HEAD>
        <BODY>
            <h2>Uw klant nummer is <?php echo $_SESSION['USER']['DATA'][0]['PersonID']; ?>.<h2></h2>
            <h2>Hieronder staan de gegevens zoals deze bij ons bekend zijn.<h2>
                    <h3>Hier kunt u uw gegeven aanpassen.</h3>
                    <form method="post" action="">
                        <div class="row align-items-start">
                            <div class="col">
                                <label class="col-6 col-sm-4">Aanhef : </label>
                            </div>
                            <div>
                                <input type="radio" name="gender" value="male" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] == 'Man'){echo "checked";} ?>> De heer
                                <input type="radio" name="gender" value="female" <?php if($_SESSION['USER']['CUSTOMER_DETAILS'][0]['Gender'] != 'Man'){echo "checked";} ?>> Mevrouw
                            </div>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Naam : </label><input type="text" name="name" placeholder= "<?php echo $_SESSION['USER']['DATA'][0]['FullName'];?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Adres : </label><input type="text" name="address" placeholder= "<?php echo $_SESSION['USER']['ADDRESS'][0]['Address'];?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Postcode : </label><input type="text" name="zipcode" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['Zipcode'];?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Woonplaats : </label><input type="text" name="city" placeholder="<?php echo $_SESSION['USER']['ADDRESS'][0]['City'];?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Emailadres : </label>
                            <input type="text" name="email" placeholder="<?php echo $_SESSION['USER']['DATA'][0]['EmailAddress'];?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <label class="col-sm-3">Geboortedatum : </label>
                            <input type="text" name="dob" placeholder="<?php $show_date= new DateTime($_SESSION['USER']['DATA'][0]['DateOfBirth']); echo date_format($show_date, 'j-m-Y');?>" class="col-sm-6"><br>
                        </div>
                        <div class="row align-items-start">
                            <input type="checkbox" name="newsletter" class="col-sm-3" <?php if ($_SESSION['USER']['CUSTOMER_DETAILS'][0]['newsletter']==1) {echo "checked";} ?>>
                            <label class="col-sm-6">Ja! Ik ontvang graag de Nieuwsbrief van Oma's Best.</label><br>
                        </div>
                    </form>
        </BODY>
    </HEAD>
</HTML>
<?php //echo "<pre>";print_r($_SESSION['USER']);echo "</pre><br>";?>