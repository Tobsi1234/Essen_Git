<?php

$sqlhost = "localhost";
$sqluser = "root";
$sqlpass = "";
$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass) or die ("DB-system nicht verfügbar");
mysqli_select_db($connection, "tobsi") or die ("Datenbank nicht verfügbar");

$pdo = new PDO('mysql:host=localhost;dbname=tobsi', 'root', '');
	
$url = $_SERVER['REQUEST_URI'];
$checkLogin = false;
$pagesToCheck = array('0' => "abstimmung.php", '1' => "locationverwaltung.php", '2' => "geheim.php");

// Das Array und die Abfrage sorgen dafür, dass der Login-Check nur bei den obigen Seiten ausgeführt wird
// Das bedeutet: Jede vom Benutzer aufrufbare Seite, bei dem er angemeldet sein muss, gehört in das Array rein!

foreach($pagesToCheck as $value) {
	if (strpos($url, $value) !== false) {
		$checkLogin = true;
	}
}

if ($checkLogin == true) {
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="index.php">einloggen</a>');
	}
}
?>