<?php
<<<<<<< HEAD

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
=======
if (!isset($_SESSION)) {
	session_start();
}

>>>>>>> origin/master
require('includes/includeDatabase.php');

if (isset($_POST['callFunction'])) {
switch ($_POST['callFunction'])
	{
		case 'insertLocation':	
			insertLocation($_POST['p1'], $_POST['p2'], $_POST['p3']);
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



?>