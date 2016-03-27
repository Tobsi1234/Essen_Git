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


?>