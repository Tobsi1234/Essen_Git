<?php 
session_start();

require('includes/includeDatabase.php');
include ("includes/includeHead.php");
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Benutzereinstellungen</title>	
</head> 
<body>

<?php
include ("includes/includeBody.php");
	
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
	$error = false;
	$username = htmlspecialchars($_POST['name']);
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
  
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 	
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();
		
		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}	
	}
	
	//Überprüfe, dass der Benutzername noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$user = $statement->fetch();
		
		if($user !== false) {
			echo 'Diesr Benutzername ist bereits vergeben<br>';
			$error = true;
		}	
	}
	
	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {	
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
		
		$statement = $pdo->prepare("INSERT INTO users (username, email, passwort) VALUES (:username, :email, :passwort)");
		$result = $statement->execute(array('username' => $username, 'email' => $email, 'passwort' => $passwort_hash));
		
		if($result) {		
			//echo 'Du wurdest erfolgreich registriert. <a href="index.php">Zur Startseite</a>';
			$showFormular = false;
			?>
			<div class="alert alert-success fade in">
  				Du wurdest erfolgreich <strong>registriert</strong>! <a href="index.php">Zur Startseite</a>
			</div>
            <?php
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	} 
}
 
if($showFormular) {
?>
<div id="register">
    <form class="form-horizontal" action="" method="post">
	<div class="form-group">
		<label class="col-lg-4"> Benutzername: </label>
		<div class="col-lg-8">
			<input class="form-control" type="text" maxlength="30" name="name" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-4"> E-Mail: </label>
		<div class="col-lg-8">
			<input class="form-control" type="email" maxlength="50" name="email" required>
		</div>
	</div>
    <div class="form-group">
		<label class="col-lg-4">Passwort: </label>
		<div class="col-lg-8">
			<input class="form-control" type="password"  maxlength="20" name="passwort" required>
		</div>
	</div>
    <div class="form-group">
		<label class="col-lg-4">Passwort wiederholen: </label>
		<div class="col-lg-8">
			<input class="form-control" type="password"  maxlength="20" name="passwort2" required>
		</div>
	</div>
    <input class="btn btn-default" type="submit" value="Abschicken">
    </form>
</div> 
<?php
} //Ende von if($showFormular)
	
// js funktionen befinden sich in includeBody
if(!isset($_SESSION['userid'])) {
	echo('<script language="javascript">hideUnterseiten();</script>');
}
else echo('<script language="javascript">showUnterseiten();</script>');
?>
 
</body>
</html>