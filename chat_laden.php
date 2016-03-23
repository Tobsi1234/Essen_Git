<?php
	require('password.php');
	$arr = array();
	$sqls1 = "SELECT * FROM tabchat";
	$result1 = mysqli_query($connection, $sqls1);
	while($row1 = mysqli_fetch_object($result1)){
		$nachricht = $row1->nachricht;
		$name = $row1->name;
		$ts = $row1->ts;
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
