<?php

	require('password.php');
	
	$name = htmlspecialchars($_GET["name"]);
	$essen = htmlspecialchars($_GET["essen"]);
	$datum = htmlspecialchars($_GET["datum"]);

	
	$sqli1 = "INSERT INTO tabperson (name) VALUES ('$name')";
	$result1 = mysqli_query($connection, $sqli1);
	
	$sqls1 = "SELECT p_ID FROM tabperson WHERE name='$name'";
	$row1 = mysqli_fetch_object(mysqli_query($connection, $sqls1));
	$p_ID = $row1->p_ID;
	
	$sqli2 = "INSERT INTO tabdatum (datum) VALUES ('$datum')";
	$result2 = mysqli_query($connection, $sqli2);
	
	$sqls2 = "SELECT d_ID FROM tabdatum WHERE datum='$datum'";
	$row2 = mysqli_fetch_object(mysqli_query($connection, $sqls2));
	$d_ID = $row2->d_ID;

	$sqli3 = "INSERT INTO tabbez (p_ID, d_ID, essen) VALUES ('$p_ID', '$d_ID', '$essen')";
	$result3 = mysqli_query($connection, $sqli3);
	
	$sqlu1 = "UPDATE tabbez SET essen='$essen' WHERE d_ID='$d_ID' AND p_ID='$p_ID'";
	$result4 = mysqli_query($connection, $sqlu1);
?>
