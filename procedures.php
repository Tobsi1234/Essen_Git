<?php

if (!isset($_SESSION)) {
	session_start();
}

require('includes/includeDatabase.php');

if (isset($_POST['callFunction'])) {
switch ($_POST['callFunction'])
	{
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
			gruppeErstellen($_POST['name'], $_POST['u_ID']);
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
	
	return $sqlSelEssenRes;
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

	$stmt1 = $pdo->prepare("SELECT username FROM users WHERE email = :email");
	$stmt1->execute(array('email' => $email));
	$email = $stmt1->fetch();
	//if(!isset($email[0])) echo "null";
	echo $email[0];

}

function gruppeErstellen($name, $u_ID) {

	require('includes/includeDatabase.php');

	$stmt1 = $pdo->prepare("INSERT INTO gruppe (name, u_ID) VALUES (:name, :u_ID)");
	$stmt1->execute(array('name' => $name, 'u_ID' => $u_ID));

	$stmt2 = $pdo->prepare("SELECT g_ID FROM gruppe WHERE name = :name");
	$stmt2->execute(array('name' => $name));
	$g_ID = $stmt2->fetch();

	$stmt3 = $pdo->prepare("UPDATE users SET g_ID = :g_ID WHERE u_ID = :u_ID");
	$stmt3->execute(array('g_ID' => $g_ID[0], 'u_ID' => $u_ID));

}

?>
