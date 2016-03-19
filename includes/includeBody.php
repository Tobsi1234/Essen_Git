<!DOCTYPE html>
<html lang="de">
<body>
<?php
	$currentUsername = null;
	$currentPassword = null;
	if (isset($_SESSION["username"]) && isset($_SESSION["password"] )) {

	$currentUsername = $_SESSION["username"];
	$currentPassword = $_SESSION["password"];
	}

	if ((!($currentUsername=="Tobias" and $currentPassword=="Tobias_1a2s3d")) && (!($currentUsername=="Dominik" and $currentPassword=="Dominik_1a2s3d")) && (!($currentUsername=="Quentin" and $currentPassword=="Quentin_1a2s3d"))&& (!($currentUsername=="Tilo" and $currentPassword=="Tilo_1a2s3d")))
	{
		  echo("Lädt...");
		  echo "<script type='text/javascript'>myFunction();</script>";
	}
?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Startseite</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="edit.php">Abstimmung</a>
                    </li>
					<li>
                        <a href="locationverwaltung.php">Essen hinzufügen</a>
                    </li>
					<li>
                        <a href="">Verlauf</a>
                    </li>
					<li>
                        <a href="">Einstellungen</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</body>
</html>