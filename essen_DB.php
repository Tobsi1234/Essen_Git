<?php

	require('password.php');
	
	$name = htmlspecialchars($_GET["name"]);
	$essen = htmlspecialchars($_GET["essen"]);
	$datum = htmlspecialchars($_GET["datum"]);

	
	$sqli1 = "INSERT INTO tabname (name) VALUES ('$name')";
	$result1 = mysql_query($sqli1);
	
	$sqls1 = "SELECT n_ID FROM tabname WHERE name='$name'";
	$row1 = mysql_fetch_object(mysql_query($sqls1));
	$n_ID = $row1->n_ID;
	
	$sqli2 = "INSERT INTO tabdatum (datum) VALUES ('$datum')";
	$result2 = mysql_query($sqli2);
	
	$sqls2 = "SELECT d_ID FROM tabdatum WHERE datum='$datum'";
	$row2 = mysql_fetch_object(mysql_query($sqls2));
	$d_ID = $row2->d_ID;

	$sqli3 = "INSERT INTO tabbez (n_ID, d_ID, essen) VALUES ('$n_ID', '$d_ID', '$essen')";
	$result3 = mysql_query($sqli3);
	
	$sqlu1 = "UPDATE tabbez SET essen='$essen' WHERE d_ID='$d_ID' AND n_ID='$n_ID'";
	$result4 = mysql_query($sqlu1);
?>
