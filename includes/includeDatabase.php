<script language="javascript">

            function logoutchange() {
				var username = "<?php echo($_SESSION['username']) ?>";
				$('#login-trigger').html(username + ' <span>&#x25BC;</span>');
				$('#login-content').html('<a href="einstellungen.php">Benutzereinstellungen</a></br></br><a href="logout.php">Logout</a>');
				$('#login-content').css('width', '175px'); 
                
            }
			function loginalert() {
				alert ("Bitte zuerst einloggen");
				window.location = "index.php";	
			}
</script>

<?php

$sqlhost = "localhost";
$sqluser = "root";
$sqlpass = "";
$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass) or die ("DB-system nicht verfügbar");
mysqli_select_db($connection, "tobsi") or die ("Datenbank nicht verfügbar");

$pdo = new PDO('mysql:host=localhost;dbname=tobsi', 'root', '');

//Prüfen ob eingeloggt um Statuswechsel beim Login Feld zu machen.
if(isset($_SESSION['userid'])) {
	echo '<script language="javascript">logoutchange();</script>';
}	
	
$url = $_SERVER['REQUEST_URI'];
$checkLogin = false;
$pagesToCheck = array('0' => "abstimmung.php", '1' => "locationverwaltung.php", '2' => "geheim.php");

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
