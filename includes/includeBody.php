<?php 
require('includes/includeDatabase.php');

if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();
		
	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['u_ID'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['email'] = $user['email'];  
		//die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
	} else {
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
	}	
}
?>
<script language="javascript">

	function hideUnterseiten() {
		$('.unterSeiten').hide();
		$('#container').hide();
		$('#loggedOutSeite').show();
	}
	function showUnterseiten() {
		$('.unterSeiten').show();
		$('#container').show();
		$('#loggedOutSeite').hide();
	}

	function logoutchange() {
		var username = "<?php if(isset($_SESSION['userid'])) echo($_SESSION['username']) ?>";
		$('#login-trigger').html(username + ' <span>&#x25BC;</span>');
		$('#login-content').html('<a href="benutzereinstellungen.php">Benutzereinstellungen</a></br></br><a href="logout.php">Logout</a>');
		$('#login-content').css('width', '175px'); 
	}
	function loginalert() {
		alert ("Bitte zuerst einloggen");
		window.location = "index.php";	
	}
</script>
<!DOCTYPE html>
<html lang="de">
<body>
<?php 
if(isset($errorMessage)) {
	echo $errorMessage;
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
                    <li class="unterSeiten">
                        <a href="abstimmung.php">Abstimmung</a>
                    </li>
					<li class="unterSeiten">
                        <a href="locationverwaltung.php">Essen hinzufügen</a>
                    </li>
					<li class="unterSeiten">
                        <a href="">Verlauf</a>
                    </li>
					<li class="unterSeiten">
                        <a href="">Einstellungen</a>
                    </li>                    
                    <li id="login">
                        <a id="login-trigger" href="#">
                            Einloggen <span>&#x25BC;</span>
                        </a>
                            <div id="login-content">
                                 <form action="?login=1" method="post">
                                    <fieldset id="inputs">
                                        <input id="username" type="email" name="email" placeholder="E-Mail Adresse" required>   
                                        <input id="password" type="password" name="passwort" placeholder="Passwort" required>
                                    </fieldset>
                                    <fieldset id="actions">
                                        <input type="submit" id="submit" value="Einloggen">
                                        <label><input type="checkbox" checked="checked">Eingeloggt bleiben?</label>
                                        <label><a href="registrieren.php">Noch nicht registriert? </a></label>
                                    </fieldset>
                                </form>
                            </div>                     
        			</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>  
</body>
</html>
