<?php
	session_start();
	require("includes/includeDatabase.php");
	include("includes/includeHead.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<title>Benutzereinstellungen</title>	
</head>
<body>

<?php
	include("includes/includeBody.php");
?>

<div class="userchange">
      <form class="form-horizontal" action="?pwchange=1" method="post">
       <fieldset>
  		<legend>Passwort ändern</legend>
      <div class="form-group">
      	<div class="labelrechts">
          <label class="labeluser"> Benutzername: </label>
          <input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['username']) ?>" disabled="disabled">
          <label class="labelemail"> E-Mail: </label>
          <input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['email']) ?>" disabled="disabled">
          </div>
      </div><br>
      <div class="form-group">
          <label class="col-lg-4">altes Passwort: </label>
          <div class="col-lg-8">
              <input class="passwort" type="password"  maxlength="20" name="passwort" required>
          </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4">neues Passwort: </label>
          <div class="col-lg-8">
              <input class="passwort" type="password"  maxlength="20" name="passwort2" required>
          </div>
      </div>
      <input class="btn btn-default" type="submit" value="speichern">
      </fieldset>
      </form>
</div>

<div class="userchange">
      <form class="form-horizontal" action="?pwchange=1" method="post">
      <fieldset>
  		<legend>Benutzerkonto löschen</legend>
      <div class="form-group">
      	<div class="labelrechts">
          <label class="labeluser"> Benutzername: </label>
          <input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['username']) ?>" disabled="disabled">
          <label class="labelemail"> E-Mail: </label>
          <input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['email']) ?>" disabled="disabled">
          </div>
      </div><br>
      <div class="form-group">
          <label class="col-lg-4">Passwort zur Sicherheit eingeben: </label>
          <div class="col-lg-8">
              <input class="passwort" type="password"  maxlength="20" name="passwort" required>
          </div>
      </div>
      <div class="form-group">
          <p class="labeluser">Ich bin damit einverstanden, dass mein Benutzerkonto endgültig <big>gelöscht</big> wird.</p>
      </div>
      <input class="btn btn-default" type="submit" value="löschen">
      </fieldset>
      </form>
</div>

<?php
	include("includes/includeFooter.php");
?>			
</body>
</html>
