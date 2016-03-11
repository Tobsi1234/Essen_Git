<?php
	require('password.php');
	
	$name = htmlspecialchars($_GET["name"]);
	$sqli1 = "INSERT INTO tabessen (value) VALUES ('$name')";
	$result1 = mysql_query($sqli1);
?>
