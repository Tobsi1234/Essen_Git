<?php
	require('includes/includeDatabase.php');
	$arr = array();
	$stmt1 = $pdo->prepare("SELECT * FROM tabchat");
	$stmt1->execute();
	foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row1){
		$nachricht = $row1['nachricht'];
		$name = $row1['name'];
		$ts = $row1['ts'];
		$message = array(
			"name" => $name,
			"nachricht" => $nachricht,
			"ts" => $ts
		);
		//echo("<b>" . $name . ":</b> " . $nachricht . "<br>");
		$arr[] = json_encode($message);
 	}
	print json_encode($arr);
?>
