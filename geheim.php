<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
echo "Hallo: ".$email;
//echo "Hallo User: ".$userid;
?>