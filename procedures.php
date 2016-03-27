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

		default:
			echo "Das klappt nicht!";
			break;
	}
}
			
function insertLocation($locname, $locpage, $locessen)
{

	global $pdo;
	$pdolocal = $pdo;

	require('includes/includeDatabase.php');
	
	$sqlInsLoc = $pdolocal->prepare("INSERT INTO tablocation (name, link, u_ID) VALUES (:locname, :locpage, :userid)");
	$sqlInsLocRes = $sqlInsLoc->execute(array('locname' => $locname, 'locpage' => $locpage, 'userid' => $_SESSION['userid']));
	
	
	/*$sqlInsLocEssen = $pdolocal->prepare("INSERT INTO tablocessen (name, link, p_ID) VALUES (:locname, :locpage, :userid)");
	$sqlInsLocEssenRes = $sqlInsLocEssen->execute(array(':locname' => $locname, ':locpage' => $locpage, ':userid' => $_SESSION['userid']));*/
	
	/*$sqlInsLoc = $pdolocal->prepare("INSERT INTO tablocation (name, link, p_ID) VALUES (:locname, :locpage, :userid)");
	$sqlInsLocRes = $statement->execute(array(':locname' => $locname, ':locpage' => $locpage, ':userid' => $_SESSION['userid']));*/
	
	// $sql2 = "INSERT INTO tablocation (name, link, p_ID) VALUES ('$locname', '$locpage', 2)";
	// echo $result1;
	/*
	$sqls1 = "SELECT p_ID FROM tabperson WHERE name='$name'";
	$row1 = mysqli_fetch_object(mysqli_query($connection, $sqls1));
	$p_ID = $row1->p_ID;
	
	$sqli2 = "INSERT INTO tabdatum (datum) VALUES ('$datum')";
	$result2 = mysqli_query($connection, $sqli2);
	
	$sqls2 = "SELECT d_ID FROM tabdatum WHERE datum='$datum'";
	$row2 = mysqli_fetch_object(mysqli_query($connection, $sqls2));
	$d_ID = $row2->d_ID;

	$sqli3 = "INSERT INTO tabbez (p_ID, d_ID, essen) VALUES ('$p_ID', '$d_ID', '$essen')";
	$result3 = mysqli_query($connection, $sqli3);
	
	$sqlu1 = "UPDATE tabbez SET essen='$essen' WHERE d_ID='$d_ID' AND p_ID='$p_ID'";
	$result4 = mysqli_query($connection, $sqlu1);*/
}

function reloadEssen() {
	global $pdo;
	$pdolocal = $pdo;

	$sqlInsEssen = $pdolocal->prepare("SELECT * FROM tabessen");
	$sqlInsEssen->execute();
	$sqlInsEssenRes = $sqlInsEssen->fetch();
	
	return $sqlInsEssenRes;
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