<?php
	//alle js funktionen befinden sich in includeBody
	
	if(!isset($_SESSION['userid'])) {
		echo('<script language="javascript">hideUnterseiten();</script>');
	}
	else echo('<script language="javascript">showUnterseiten();</script>');
		
	//Prüfen ob eingeloggt um Statuswechsel beim Login Feld zu machen.
	if(isset($_SESSION['userid'])) {
		echo '<script language="javascript">logoutchange();</script>';
	}	
		
	$url = $_SERVER['REQUEST_URI'];
	$checkLogin = false;

	$pagesToCheck = array('0' => "abstimmung.php", '1' => "locationverwaltung.php", '2' => "geheim.php", '3' =>"benutzereinstellungen.php");
	// Das Array und die Abfrage sorgen dafür, dass der Login-Check nur bei den obigen Seiten ausgeführt wird
	// Das bedeutet: Jede vom Benutzer aufrufbare Seite, bei dem er angemeldet sein muss, gehört in das Array rein!
	$checkLogin = false;
	foreach($pagesToCheck as $value) {
		if (strpos($url, $value) !== false) {
			$checkLogin = true;
		}
	}

	if ($checkLogin) {
		if(!isset($_SESSION['userid'])) {
			die('<script language="javascript">loginalert();</script>');
		}

	}
?>
