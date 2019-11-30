<?php
include "ActorFuncties.php";

$acteurs= $_POST["naampje"];
echo "We got is " . $acteurs."<br>";

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

?>

