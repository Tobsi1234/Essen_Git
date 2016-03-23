<!DOCTYPE html>
<html lang="de">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Essen</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->

    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    
    <link href="css/login.css" rel="stylesheet">
	
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
<script language="javascript">
<!--
	var username, password;	
	function myFunction() {
		username = prompt("Please enter your name");
		password = prompt("Please enter your password");

		window.location.href = "index.php?username=" + username + "&password=" + password;
		
		<?php
		if (isset($_GET["username"]) && isset($_GET["password"] )) {
		$_SESSION["username"] = $_GET["username"];
		$_SESSION["password"] = $_GET["password"];
		}
		?>	
	}   
-->
</script>

<script language="javascript">
$(document).ready(function(){
    $('#login-trigger').click(function() {
        $(this).next('#login-content').slideToggle();
        $(this).toggleClass('active');                    
        
        if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
        })
});
</script>

</head>
</html>