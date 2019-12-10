<HTML lang="NL">
    <HEAD>
        <BODY>
            <h2>Uw klant nummer is <?php echo $_SESSION['USER']['DATA'][0]['PersonID']; ?>.<h2></h2>
            <h2>Hieronder staan de gegevens zoals deze bij ons bekend zijn.<h2>
                    <h3>Hier kunt u uw gegeven aanpassen.</h3>
                    <form action="">
                        Aanhef :
                        <input type="radio" name="gender" value="male"> De heer
                        <input type="radio" name="gender" value="female"> Mevrouw<br>
                    </form>
                    


    </BODY>
    </HEAD>
</HTML>
<?php
echo "<pre>";print_r($_SESSION['USER']['DATA']);echo "</pre><br>";?>