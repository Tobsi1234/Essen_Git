<?php

if (!isset($_SESSION)) {
	session_start();
}

require('includes/includeDatabase.php');

if (isset($_POST['callFunction'])) {
switch ($_POST['callFunction']) {

	case 'insertLocation':
		insertLocation($_POST['p1'], $_POST['p2'], $_POST['p3']);
		break;

	case 'abstimmen':
		if(isset($_POST['essen2']))	abstimmen($_POST['u_ID'], $_POST['essen1'], $_POST['essen2'], $_POST['datum']);
		else abstimmen($_POST['u_ID'], $_POST['essen1'], "", $_POST['datum']);
		break;

	case 'insertEssen':
		insertEssen($_POST['p1']);
		break;

	case 'reloadEssen':
		reloadEssen();
		break;

	case 'emailPrüfen':
		emailPrüfen($_POST['email']);
		break;

	case 'gruppeErstellen':
		gruppeErstellen($_POST['name'], $_POST['u_ID'], $_POST['json']);
		break;

	case 'austreten':
		austreten($_POST['u_ID']);
		break;

	case 'getLocations':
		getLocations();
		break;

	case 'mitgliederHinzufügen':
		mitgliederHinzufügen($_POST['u_ID'], $_POST['json']);
		break;

	case 'getDatesFromAbstimmung':
		getDatesFromAbstimmung();
		break;

	case 'getAbstimmungsErgebnisse':
		getAbstimmungsErgebnisse();
		break;

	case 'load_page':
		load_page($_POST['page']);
		break;

	case 'getAbstimmungenHeute':
		getAbstimmungenHeute();
		break;

	case 'calculateErgebnisHeute':
		calculateErgebnisHeute();
		break;

	default:
		echo "Keine Funktion zum Aufrufen gefunden!";
		break;
	}
}
			
function insertLocation($locname, $locpage, $locessen) {

	global $pdo;
	$pdolocal = $pdo;

	require('includes/includeDatabase.php');
	
	$sqlInsLoc = $pdolocal->prepare("INSERT INTO location (name, link, u_ID) VALUES (:locname, :locpage, :userid)");
	$sqlInsLocRes = $sqlInsLoc->execute(array('locname' => $locname, 'locpage' => $locpage, 'userid' => $_SESSION['userid']));
	
	$sqlInsLocEssen = $pdolocal->prepare("INSERT INTO locessen (l_ID, e_ID) VALUES (:l_ID, :e_ID)");
		
	$sqlGetLocId = $pdolocal->prepare("SELECT l_ID FROM location WHERE name = :locname AND link = :locpage AND u_ID = :userid");
	$sqlGetLocId->execute(array('locname' => $locname, 'locpage' => $locpage, 'userid' => $_SESSION['userid']));
	$sqlGetLocIdRes = $sqlGetLocId->fetch();

	foreach ($locessen as $value) {
		
		$sqlGetEssenId = $pdolocal->prepare("SELECT e_ID FROM essen WHERE name = :essenName");
		$sqlGetEssenId->execute(array('essenName' => $value));
		$sqlGetEssenIdRes = $sqlGetEssenId->fetch();
		
		$sqlInsLocEssenRes = $sqlInsLocEssen->execute(array(':l_ID' => $sqlGetLocIdRes['l_ID'], ':e_ID' => $sqlGetEssenIdRes['e_ID']));
	}
	
	echo $locname;
}

function insertEssen($essenName) {

	global $pdo;
	$pdolocal = $pdo;

	require('includes/includeDatabase.php');
	
	$sqlInsEssen = $pdolocal->prepare("INSERT INTO essen (name, u_ID) VALUES (:essenName, :userid)");
	$sqlInsEssenRes = $sqlInsEssen->execute(array('essenName' => $essenName, 'userid' => $_SESSION['userid']));
	
	header("Location: locationverwaltung.php");
}

function reloadEssen() {
	
	global $pdo;
	$pdolocal = $pdo;
	
	$sqlSelEssen = $pdolocal->prepare("SELECT name FROM essen");
	$sqlSelEssen->execute();
	$sqlSelEssenRes = $sqlSelEssen->fetchAll();
	
	echo json_encode($sqlSelEssenRes);
}

function abstimmen($u_ID, $essen1, $essen2, $datum) {
	require('includes/includeDatabase.php');

	/*	$stmt1 = $pdo->prepare("INSERT INTO person (name) VALUES (:name)");
	$stmt1->execute(array('name' => $name));
	
	$stmt2 = $pdo->prepare("SELECT p_ID FROM person WHERE name = :name");
	$stmt2->execute(array('name' => $name));
	$p_ID = $stmt2->fetch(); */

	$stmt5 = $pdo->prepare("INSERT INTO essen (name) VALUES (:name)");
	$stmt5->execute(array('name' => $essen1));
	
	$stmt6 = $pdo->prepare("SELECT e_ID FROM essen WHERE name = :name");
	$stmt6->execute(array('name' => $essen1));
	$e_ID1 = $stmt6->fetch();
	
	if($essen2 != "") {
		$stmt7 = $pdo->prepare("INSERT INTO essen (name) VALUES (:name)");
		$stmt7->execute(array('name' => $essen2));
	
		$stmt8 = $pdo->prepare("SELECT e_ID FROM essen WHERE name = :name");
		$stmt8->execute(array('name' => $essen2));
		$e_ID2 = $stmt8->fetch();
	}

	if($essen2 == "") {	
		$stmt9 = $pdo->prepare("INSERT INTO abstimmen (u_ID, datum, e_ID1) VALUES (:u_ID, :datum, :e_ID1)");
		$stmt9->execute(array('u_ID' => $u_ID[0], 'datum' => $datum, 'e_ID1' => $e_ID1[0]));
		
		$stmt10 = $pdo->prepare("UPDATE abstimmen SET e_ID1 = :e_ID1, e_ID2 = null WHERE datum = :datum AND u_ID = :u_ID");
		$stmt10->execute(array('u_ID' => $u_ID[0], 'datum' => $datum, 'e_ID1' => $e_ID1[0]));
	}
	else {
		$stmt9 = $pdo->prepare("INSERT INTO abstimmen (u_ID, datum, e_ID1, e_ID2) VALUES (:u_ID, :datum, :e_ID1, :e_ID2)");
		$stmt9->execute(array('u_ID' => $u_ID[0], 'datum' => $datum, 'e_ID1' => $e_ID1[0], 'e_ID2' => $e_ID2[0]));
		
		$stmt10 = $pdo->prepare("UPDATE abstimmen SET e_ID1 = :e_ID1, e_ID2 = :e_ID2 WHERE datum = :datum AND u_ID = :u_ID");
		$stmt10->execute(array('u_ID' => $u_ID[0], 'datum' => $datum, 'e_ID1' => $e_ID1[0], 'e_ID2' => $e_ID2[0]));
	}
}

function emailPrüfen($email) {

	require('includes/includeDatabase.php');

	$stmt1 = $pdo->prepare("SELECT username FROM users WHERE email = :email AND g_ID IS NULL"); //gibt es benutzer und ist er noch frei?
	$stmt1->execute(array('email' => $email));
	$email = $stmt1->fetch();
	//if(!isset($email[0])) echo "null";
	echo $email[0];

}

function gruppeErstellen($name, $u_ID, $json) {

	require('includes/includeDatabase.php');
	$mitglieder = json_decode($json, TRUE);

	$stmt1 = $pdo->prepare("INSERT INTO gruppe (name, u_ID) VALUES (:name, :u_ID)"); //Gruppenname + Admin
	$stmt1->execute(array('name' => $name, 'u_ID' => $u_ID));

	$stmt2 = $pdo->prepare("SELECT g_ID FROM gruppe WHERE u_ID = :u_ID");
	$stmt2->execute(array('u_ID' => $u_ID));
	$g_ID = $stmt2->fetch();

	$stmt3 = $pdo->prepare("UPDATE users SET g_ID = :g_ID WHERE u_ID = :u_ID"); //User Gruppe zuweisen
	$stmt3->execute(array('g_ID' => $g_ID[0], 'u_ID' => $u_ID));

	for($i=0; $i<count($mitglieder); $i++) {
		$stmt1 = $pdo->prepare("UPDATE users SET g_ID = :g_ID WHERE username = :username"); //anderen Usern Gruppe zuweisen
		$stmt1->execute(array('g_ID' => $g_ID[0], 'username' => $mitglieder[$i]));
	}
}

function austreten($u_ID) {
	require('includes/includeDatabase.php');

	$stmt1 = $pdo->prepare("SELECT g_ID FROM gruppe WHERE u_ID = :u_ID"); //ist User admin?
	$stmt1->execute(array('u_ID' => $u_ID));
	$g_ID = $stmt1->fetch();

	if($g_ID[0] != "") {
		$stmt2 = $pdo->prepare("DELETE FROM gruppe WHERE g_ID = :g_ID"); //wenn ja, lösch die ganze Gruppe
		$stmt2->execute(array('g_ID' => $g_ID[0]));
	}

	$stmt3 = $pdo->prepare("UPDATE users SET g_ID = NULL WHERE u_ID = :u_ID"); //lösch die verlinkung des users auf die Gruppe
	$stmt3->execute(array('u_ID' => $u_ID));

}

/* nicht hinbekommen */
function getLocations(){
	require('includes/includeDatabase.php');
	
	$stmt1 = $pdo->prepare("SELECT name, link FROM location");
	$stmt1->execute(array('name' => $name, 'link' => $link));
	$locationsreturn = $stmt1->fetch();
}

function mitgliederHinzufügen($u_ID, $json) {
	require('includes/includeDatabase.php');

	$mitglieder = json_decode($json, TRUE);

	$stmt1 = $pdo->prepare("SELECT g_ID FROM gruppe WHERE u_ID = :u_ID"); //gruppen ID bekommen
	$stmt1->execute(array('u_ID' => $u_ID));
	$g_ID = $stmt1->fetch();

	for($i=0; $i<count($mitglieder); $i++) {
		$stmt2 = $pdo->prepare("UPDATE users SET g_ID = :g_ID WHERE username = :username"); //Usern Gruppe zuweisen
		$stmt2->execute(array('g_ID' => $g_ID[0], 'username' => $mitglieder[$i]));
		echo $mitglieder[$i];
	}
}

function getDatesFromAbstimmung() {
	global $pdo;
	$pdolocal = $pdo;

	$sqlSelDates = $pdolocal->prepare("SELECT DISTINCT datum FROM abstimmung_ergebnis WHERE g_ID = :g_ID");
	$sqlSelDates->execute(array('g_ID' => $_SESSION['g_ID']));
	$sqlSelDatesRes = $sqlSelDates->fetchAll();

	echo json_encode($sqlSelDatesRes);
}

function getAbstimmungsErgebnisse() {
	global $pdo;
	$pdolocal = $pdo;

	$sqlSelAbst = $pdolocal->prepare("SELECT * FROM abstimmung_ergebnis WHERE g_ID = :g_ID ORDER BY datum DESC");
	$sqlSelAbst->execute(array('g_ID' => $_SESSION['g_ID']));
	$sqlSelAbstRes = $sqlSelAbst->fetchAll();
	$i = 0;
	foreach ($sqlSelAbstRes as $value) {
		$sqlSelLocname = $pdolocal->prepare("SELECT name FROM location WHERE l_ID = :l_ID");
		$sqlSelLocname->execute(array('l_ID' => $value['l_ID']));
		$sqlSelLocnameRes = $sqlSelLocname->fetch();
		$sqlSelAbstRes[$i]['locname'] = $sqlSelLocnameRes['name'];

		$sqlSelGruppe = $pdolocal->prepare("SELECT name FROM gruppe WHERE g_ID = :g_ID");
		$sqlSelGruppe->execute(array('g_ID' => $value['g_ID']));
		$sqlSelGruppeRes = $sqlSelGruppe->fetch();
		$sqlSelAbstRes[$i]['gruppe'] = $sqlSelGruppeRes['name'];

		$i++;
	}

	echo json_encode($sqlSelAbstRes);
}

function load_page($page) {

	if(file_exists('pages/'.$page.'.php'))
		echo file_get_contents('pages/'.$page.'.php');

	else echo 'There is no such page!'.$page;

}

function getAbstimmungenHeute() {
	global $pdo;
	$pdolocal = $pdo;

	$abstHeute = selectAbstimmungenHeute();

	$sqlSelAbstHeuteRes = $abstHeute;
	$i = 0;

	foreach ($sqlSelAbstHeuteRes as $value) {
		// Hole Usernamen der heutigen Abstimmer
		$sqlSelHilfsUsers = $pdolocal->prepare('SELECT username FROM users WHERE u_ID = :u_ID');
		$sqlSelHilfsUsers->execute(array('u_ID' => $value['u_ID']));
		$sqlSelHilfsUsersRes = $sqlSelHilfsUsers->fetch();
		$sqlSelAbstHeuteRes[$i]['username'] = $sqlSelHilfsUsersRes['username'];

		// Hole Gruppennamen der zugehörigen Gruppe
		$sqlSelHilfsGruppe = $pdolocal->prepare('SELECT gruppe.name FROM gruppe WHERE g_ID = :g_ID');
		$sqlSelHilfsGruppe->execute(array('g_ID' => $value['g_ID']));
		$sqlSelHilfsGruppeRes = $sqlSelHilfsGruppe->fetch();
		$sqlSelAbstHeuteRes[$i]['gruppe'] = $sqlSelHilfsGruppeRes['name'];

		// Hole die je zwei Essensbezeichnungen, für die der User abgestimmt hat. Bei doppelten Nennungen sorgt die if-Abfrage auch für eine doppelte Speicherung
		$sqlSelHilfsUsers = $pdolocal->prepare('SELECT name FROM essen WHERE e_ID = :e_ID1 OR e_ID = :e_ID2');
		$sqlSelHilfsUsers->execute(array('e_ID1' => $value['e_ID1'], 'e_ID2' => $value['e_ID2']));
		$sqlSelHilfsUsersRes = $sqlSelHilfsUsers->fetchAll();
		$sqlSelAbstHeuteRes[$i]['essen1'] = $sqlSelHilfsUsersRes[0]['name'];
		if (!isset($sqlSelHilfsUsersRes[1]['name'])) {$sqlSelHilfsUsersRes[1]['name'] = $sqlSelHilfsUsersRes[0]['name'];}
		$sqlSelAbstHeuteRes[$i]['essen2'] = $sqlSelHilfsUsersRes[1]['name'];
		$i++;
	}

	echo json_encode($sqlSelAbstHeuteRes);
}

function calculateErgebnisHeute() {
	global $pdo;
	$pdolocal = $pdo;

	$sqlSelAbstHeuteRes = selectAbstimmungenHeute();
	$abstimmungen = array();

	// Fülle Array abstimmungen mit allen e_IDs, für die heute abgestimmt wurde
	for($i = 0; $i < (count($sqlSelAbstHeuteRes))*2; $i = $i+2) {
		$abstimmungen[$i] = $sqlSelAbstHeuteRes[$i/2]['e_ID1'];
		$abstimmungen[$i+1] = $sqlSelAbstHeuteRes[$i/2]['e_ID2'];
	}

	// Ermittle das Essen, für welches am häufigsten abgestimmt wurde
	$häufigkeiten = array_count_values($abstimmungen);
	arsort($häufigkeiten);

	// Hole alle Location-IDs, welches dieses Essen anbieten
	$sqlSelLoc = $pdolocal->prepare("SELECT l_ID FROM locessen WHERE e_ID = :e_ID");
	$sqlSelLoc->execute(array('e_ID' => key($häufigkeiten)));
	$sqlSelLocRes = $sqlSelLoc->fetchAll();


	$zufallszahl = mt_rand(0,count($sqlSelLocRes)-1);

	// Hole den Namen einer per Zufall ermittelten Location, die dieses Essen anbietet
	$sqlSelLocname = $pdolocal->prepare("SELECT name FROM location WHERE l_ID = :l_ID");
	$sqlSelLocname->execute(array('l_ID' => $sqlSelLocRes[$zufallszahl]['l_ID']));
	$sqlSelLocnameRes = $sqlSelLocname->fetch();

	echo $sqlSelLocnameRes['name'];
}

// Reine serverseitige Hilfsfunktion, daher kein Eintrag im Switch-Statement nötig!
function selectAbstimmungenHeute() {
	global $pdo;
	$pdolocal = $pdo;
	date_default_timezone_set("Europe/Berlin");

	// Hole alle heutigen Abstimmungen von allen Usern der Gruppe, der der aktuelle User angehört
	$sqlSelAbstHeute = $pdolocal->prepare("SELECT abstimmen.u_ID, g_ID, e_ID1, e_ID2 FROM abstimmen, users WHERE users.u_ID = abstimmen.u_ID AND datum = :datum AND users.g_ID = :g_ID");
	$sqlSelAbstHeute->execute(array('datum' => date("Y-m-d",time()),'g_ID' => $_SESSION['g_ID']));
	$sqlSelAbstHeuteRes = $sqlSelAbstHeute->fetchAll();

	return $sqlSelAbstHeuteRes;
}
?>
