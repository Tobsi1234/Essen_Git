<?php
	require('password.php');

	$sqls1 = "SELECT * FROM tabchat";
	$result1 = mysqli_query($connection, $sqls1);
	while($row1 = mysqli_fetch_object($result1)){
		$nachricht = $row1->nachricht;
		$name = $row1->name;
		
		echo("<b>" . $name . ":</b> " . $nachricht . "<br>");
	}
?>
