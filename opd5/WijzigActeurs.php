<html>
<?php
include "ActorFuncties.php";

$recid= $_GET["recid"];
echo "We got is " . $recid."<br>";

$result=Select("Select * from actor where actor_id=".$recid);
print_r($result);


/*
$result=Select("Select * from actor where last_name=upper(\"".$acteurs."\")");

echo "<html><table>";

foreach ($result[0] as $key => $value) {
	echo "<th>". $key . "</th>";
}

foreach ($result as $key => $value) {
	echo "<tr>";
	foreach ($result[$key] as $key1 => $value) {
		echo "<td>".$result[$key][$key1]."</td>";
		
	}
	echo "</tr>";
}

echo "</table></html>";
*/
?>
<h1>Wijzigen acteurs</h1>
<form method="post" action=<?php echo "\"WijzigActeurs.php?recid=".$recid."\"";?>><input type="submit" value="Clear"></form>
<form action="index.php"><input type="submit" value="Back"></form>
	<form method="post" action="">
		ID :<input type="text" <?php echo "value=\"".$result[0]['actor_id']."\"" ?> name="actor_id" disabled><br>
		Voornaam :<input type="text" <?php echo "value=\"".$result[0]['first_name']."\"" ?> name="first_name"><br>
		Achternaam :<input type="text" <?php echo "value=\"".$result[0]['last_name']."\"" ?>  name="last_name"><br>
		Geboortedatum :<input type="text" <?php echo "value=\"".$result[0]['date_of_birth']."\"" ?>  name="date_of_birth"><br>
		<input type="hidden" name="verstuurd"><br> 
		<input type="submit" value="Verstuur">
	</form>
</html>