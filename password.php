<?php
$sqlhost = "localhost";
$sqluser = "";
$sqlpass = "";

mysql_connect($sqlhost, $sqluser, $sqlpass) or die ("DB-system nicht verfügbar");
mysql_select_db("tobsi") or die ("Datenbank nicht verfügbar");

?>
