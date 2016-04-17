<?php
session_start();

	require('includes/includeDatabase.php');

	$name = $_GET["name"];
	$nachricht = htmlspecialchars($_GET["nachricht"]);
	$stmt1 = $pdo->prepare("INSERT INTO chat (name, nachricht, g_ID) VALUES (:name, :nachricht, :g_ID)");
	$result1 = $stmt1->execute(array('name' => $name, 'nachricht' => $nachricht, 'g_ID' => $_SESSION['g_ID']));
?>
