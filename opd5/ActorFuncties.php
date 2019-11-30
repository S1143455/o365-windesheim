<?php
$host = "localhost";
$user = "root";
$pass = "";
$databasename = "sakila";

function MaakVerbinding(){
	global $host, $user, $pass, $databasename;
	$connection = mysqli_connect($host, $user, $pass, $databasename);
	if(!$connection) die("Unable to connect to MySQL: " . mysqli_error($connection));
	return $connection;
}

function SluitVerbinding($connection) {
	mysqli_close($connection);
}

function Select($sql) {
	$connection = MaakVerbinding();
	$result = mysqli_fetch_all(mysqli_query($connection, $sql),MYSQLI_ASSOC);
	SluitVerbinding($connection);
	return $result;
}

function Update($sql, $actor_id, $first_name, $last_name, $date_of_birth) {
	$connection = MaakVerbinding();
	$statement = mysqli_prepare($connection, $sql);
	mysqli_stmt_bind_param($statement,'sssi',$first_name,$last_name,$date_of_birth, $actor_id);
	mysqli_stmt_execute($statement);
	return mysqli_stmt_affected_rows($statement) == 1;
}

function ToonActeurs(){
	$result=Select("Select actor_id,first_name,last_name,date_of_birth from actor order by actor_id");
	echo "<html><table>";
	echo "<th>Nr.</th><th>Voornaam</th><th>Achternaam</th><th>Geboren</th><th>Update</th>";
	//foreach ($result[0] as $key => $value) {echo "<th>". $key . "</th>";}
	foreach ($result as $key => $value) {
		echo "<tr>";
		foreach ($result[$key] as $key1 => $value) {
			echo "<td>".$result[$key][$key1]."</td>";}
		echo "<td><a href=\"WijzigActeurs.php?recid=".$result[$key]["actor_id"]."\">Bewerk</a></td></tr>";
	}
	echo "</table></html>";
}

?>