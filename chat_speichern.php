<?php
	require('password.php');

	$name = $_GET["name"];
	$nachricht = htmlspecialchars($_GET["nachricht"]);
	$sqli1 = "INSERT INTO tabchat (name, nachricht) VALUES ('$name', '$nachricht')";
	$result1 = mysqli_query($connection, $sqli1);
?>
