<?php
	require('password.php');
	
	$name = htmlspecialchars($_GET["name"]);
	$sqli1 = "INSERT INTO tabessen (essen) VALUES ('$name')";
	$result1 = mysqli_query($connection, $sqli1);
?>
