<?php
	$verbindung = mysql_connect("localhost", "tobsi", "55775577") or die ("Fehler im System");
	mysql_select_db("tobsi") or die ("Datenbank nicht verfügbar");
	
	$name = htmlspecialchars($_GET["name"]);
	$sqli1 = "INSERT INTO tabessen (value) VALUES ('$name')";
	$result1 = mysql_query($sqli1);
	
	mysql_close($verbindung);

?>