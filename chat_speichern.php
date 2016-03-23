<?php
	require('password.php');
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="index.php">einloggen</a>');
	}
	$name = $_GET["name"];
	$nachricht = htmlspecialchars($_GET["nachricht"]);
	$sqli1 = "INSERT INTO tabchat (name, nachricht) VALUES ('$name', '$nachricht')";
	$result1 = mysqli_query($connection, $sqli1);
?>
