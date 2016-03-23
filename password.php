<?php
	$sqlhost = "localhost";
	$sqluser = "root";
	$sqlpass = "";
	$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass) or die ("DB-system nicht verfügbar");
	mysqli_select_db($connection, "tobsi") or die ("Datenbank nicht verfügbar");
?>
