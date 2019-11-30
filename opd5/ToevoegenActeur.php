<html>
<h1>Toevoegen acteurs</h1>
<form method="post" action="ToevoegenActeur.php"><input type="submit" value="Clear"></form>
<form action="index.php"><input type="submit" value="Back"></form>
	<form method="post" action="">
		ID :<input type="text" name="actor_id"><br>
		Voornaam :<input type="text" name="first_name"><br>
		Achternaam :<input type="text" name="last_name"><br>
		Geboortedatum :<input type="text" name="date_of_birth"><br>
		<input type="hidden" name="verstuurd"><br> 
		<input type="submit" value="Verstuur">
	</form>
<?php
include "ActorFuncties.php";
if (isset($_POST["first_name"])){
	if ( empty($_POST['actor_id']) || empty($_POST["first_name"]) || empty($_POST["last_name"]) || empty($_POST["date_of_birth"]) ){echo "Niet alle velden ingevuld.";} 
	else {
		$sql="insert into actor (first_name,last_name,date_of_birth,actor_id) values(?,?,?,?)";
		Update($sql,$_POST["actor_id"],$_POST["first_name"],$_POST["last_name"],$_POST["date_of_birth"]);
		echo "Acteur ". $_POST["first_name"] . " " . $_POST["last_name"] ." is toegoevoegd!";
		$_POST=array();
	}
}

else {
	echo "<br>Awaiting the data!<br>";
}

;?>



</html>
