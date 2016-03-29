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

<!-- Passwort ändern -->
<div class="userchange">
      <form class="form-horizontal" action="?pwchange=1" method="post">
       <fieldset>
  		<legend>Passwort ändern</legend>
         <table class="usertable">
            <tbody>
              <tr>
                <td><label>Benutzername:</label></td>
                <td><input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['username']) ?>" disabled="disabled"></td>
              </tr>
              <tr>
                <td><label>E-Mail:</label></td>
                <td><input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['email']) ?>" disabled="disabled"></td>
              </tr>
              <tr>
                <td><label>altes Passwort: </label></td>
                <td><input class="passwort" type="password"  maxlength="20" name="passwort" required></td>
              </tr>
              <tr>
                <td><label>neues Passwort: </label></td>
                <td><input class="passwort" type="password"  maxlength="20" name="passwort2" required></td>
              </tr>
              <tr>
                <td></td>
                <td style="text-align:right"><input class="btn btn-default" type="submit" value="speichern"></td>
              </tr>
            </tbody>
  		</table>
      </fieldset>
      </form>
</div>

<!-- Benutzerkonto löschen -->
<div class="userdelete">
      <form class="form-horizontal" action="?userdelete=1" method="post">
       <fieldset>
  		<legend>Benutzerkonto löschen</legend>
         <table class="usertable">
            <tbody>
              <tr>
                <td><label>Benutzername:</label></td>
                <td><input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['username']) ?>" disabled="disabled"></td>
              </tr>
              <tr>
                <td><label>E-Mail:</label></td>
                <td><input class="inputuser" type="text" id="name" maxlength="30" value="<?php echo($_SESSION['email']) ?>" disabled="disabled"></td>
              </tr>
              <tr>
                <td><label>Passwort zur Sicherheit eingeben:</label></td>
                <td><input class="passwort" type="password"  maxlength="20" name="passwort" required></td>
              </tr>  
            </tbody>
  		</table>
        <p class="labeluser">Ich bin damit einverstanden, dass mein Benutzerkonto endgültig gelöscht wird.</p>
        <input class="btn btn-default" type="submit" value="löschen" style="float:right; margin-right:8px">
      </fieldset>
      </form>
</div>

<?php
	include("includes/includeFooter.php");
?>			
</body>
</html>
