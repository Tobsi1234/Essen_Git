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
		
		default:
			echo "Keine Funktion zum Aufrufen gefunden!";
			break;
	}
}
			
function insertLocation($locname, $locpage, $locessen) {

	global $pdo;
	$pdolocal = $pdo;

	require('includes/includeDatabase.php');
	
	$sqlInsLoc = $pdolocal->prepare("INSERT INTO tablocation (name, link, u_ID) VALUES (:locname, :locpage, :userid)");
	$sqlInsLocRes = $sqlInsLoc->execute(array('locname' => $locname, 'locpage' => $locpage, 'userid' => $_SESSION['userid']));
	
	$sqlInsLocEssen = $pdolocal->prepare("INSERT INTO tablocessen (l_ID, e_ID) VALUES (:l_ID, :e_ID)");
		
	$sqlGetLocId = $pdolocal->prepare("SELECT l_ID FROM tablocation WHERE name = :locname AND link = :locpage AND u_ID = :userid");
	$sqlGetLocId->execute(array('locname' => $locname, 'locpage' => $locpage, 'userid' => $_SESSION['userid']));
	$sqlGetLocIdRes = $sqlGetLocId->fetch();

	foreach ($locessen as $value) {
		
		$sqlGetEssenId = $pdolocal->prepare("SELECT e_ID FROM tabessen WHERE name = :essenName");
		$sqlGetEssenId->execute(array('essenName' => $value));
		$sqlGetEssenIdRes = $sqlGetEssenId->fetch();
		
		$sqlInsLocEssenRes = $sqlInsLocEssen->execute(array(':l_ID' => $sqlGetLocIdRes['l_ID'], ':e_ID' => $sqlGetEssenIdRes['e_ID']));
	}
	
	
}

function insertEssen($essenName) {

	global $pdo;
	$pdolocal = $pdo;

	require('includes/includeDatabase.php');
	
	$sqlInsEssen = $pdolocal->prepare("INSERT INTO tabessen (name, u_ID) VALUES (:essenName, :userid)");
	$sqlInsEssenRes = $sqlInsEssen->execute(array('essenName' => $essenName, 'userid' => $_SESSION['userid']));
	
	header("Location: locationverwaltung.php");
}

function reloadEssen() {
	
	global $pdo;
	$pdolocal = $pdo;
	
	$sqlSelEssen = $pdolocal->prepare("SELECT name FROM tabessen");
	$sqlSelEssen->execute();
	$sqlSelEssenRes = $sqlSelEssen->fetchAll();
	
	return $sqlSelEssenRes;
}

function abstimmen($u_ID, $essen1, $essen2, $datum) {
	require('includes/includeDatabase.php');

	/*	$stmt1 = $pdo->prepare("INSERT INTO tabperson (name) VALUES (:name)");
	$stmt1->execute(array('name' => $name));
	
	$stmt2 = $pdo->prepare("SELECT p_ID FROM tabperson WHERE name = :name");
	$stmt2->execute(array('name' => $name));
	$p_ID = $stmt2->fetch(); */
	
	$stmt3 = $pdo->prepare("INSERT INTO tabdatum (datum) VALUES (:datum)");
	$stmt3->execute(array('datum' => $datum));
	
	$stmt4 = $pdo->prepare("SELECT d_ID FROM tabdatum WHERE datum = :datum");
	$stmt4->execute(array('datum' => $datum));
	$d_ID = $stmt4->fetch();
	
	$stmt5 = $pdo->prepare("INSERT INTO tabessen (name) VALUES (:name)");
	$stmt5->execute(array('name' => $essen1));
	
	$stmt6 = $pdo->prepare("SELECT e_ID FROM tabessen WHERE name = :name");
	$stmt6->execute(array('name' => $essen1));
	$e_ID1 = $stmt6->fetch();
	
	if($essen2 != "") {
		$stmt7 = $pdo->prepare("INSERT INTO tabessen (name) VALUES (:name)");
		$stmt7->execute(array('name' => $essen2));
	
		$stmt8 = $pdo->prepare("SELECT e_ID FROM tabessen WHERE name = :name");
		$stmt8->execute(array('name' => $essen2));
		$e_ID2 = $stmt8->fetch();
	}

	if($essen2 == "") {	
		$stmt9 = $pdo->prepare("INSERT INTO tabbez (u_ID, d_ID, e_ID1) VALUES (:u_ID, :d_ID, :e_ID1)");
		$stmt9->execute(array('u_ID' => $u_ID[0], 'd_ID' => $d_ID[0], 'e_ID1' => $e_ID1[0]));
		
		$stmt10 = $pdo->prepare("UPDATE tabbez SET e_ID1 = :e_ID1, e_ID2 = null WHERE d_ID = :d_ID AND u_ID = :u_ID");
		$stmt10->execute(array('u_ID' => $u_ID[0], 'd_ID' => $d_ID[0], 'e_ID1' => $e_ID1[0]));
	}
	else {
		$stmt9 = $pdo->prepare("INSERT INTO tabbez (u_ID, d_ID, e_ID1, e_ID2) VALUES (:u_ID, :d_ID, :e_ID1, :e_ID2)");
		$stmt9->execute(array('u_ID' => $u_ID[0], 'd_ID' => $d_ID[0], 'e_ID1' => $e_ID1[0], 'e_ID2' => $e_ID2[0]));
		
		$stmt10 = $pdo->prepare("UPDATE tabbez SET e_ID1 = :e_ID1, e_ID2 = :e_ID2 WHERE d_ID = :d_ID AND u_ID = :u_ID");
		$stmt10->execute(array('u_ID' => $u_ID[0], 'd_ID' => $d_ID[0], 'e_ID1' => $e_ID1[0], 'e_ID2' => $e_ID2[0]));
	}
}

?>