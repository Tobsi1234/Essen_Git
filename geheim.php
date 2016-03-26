<?php
	require("includes/includeDatabase.php");
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
echo "Hallo: ".$email;
//echo "Hallo User: ".$userid;
?>