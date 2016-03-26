<?php
	require('includes/includeDatabase.php');

	$name = $_GET["name"];
	$nachricht = htmlspecialchars($_GET["nachricht"]);
	$stmt1 = $pdo->prepare("INSERT INTO tabchat (name, nachricht) VALUES (:name, :nachricht)");
	$result1 = $stmt1->execute(array('name' => $name, 'nachricht' => $nachricht));
?>
