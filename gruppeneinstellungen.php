<?php
session_start();
require("includes/includeDatabase.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>

	<?php
	include ("includes/includeHead.php");
	?>

	<script language="javascript">
		<!--
		-->
	</script>
</head>
<body>

<?php
include ("includes/includeBody.php");
?>
<?php
$stmt1 = $pdo->prepare("SELECT g_ID FROM users WHERE u_ID = :u_ID");
$stmt1->execute(array('u_ID' => $_SESSION['userid']));
$g_ID = $stmt1->fetch();
if(!isset($g_ID[0])) echo "Keine Gruppe";
else {
	$stmt2 = $pdo->prepare("SELECT name FROM gruppe WHERE g_ID = :g_ID");
	$stmt2->execute(array('g_ID' => $g_ID));
	$gruppenname = $stmt2[0];
	echo $gruppenname;
}
?>

<!-- Page Content -->
<div class="container">

	<!-- First Featurette -->
	<div class="featurette" id="about">
		<?php
		if(!isset($g_ID[0])) {
			?>
			<div id="headline">
				<h1>Neue Gruppe anlegen: </h1><br>
			</div>
			<div class="form-horizontal">
				<form class="form-inline" id="formAnlegen" name="formAnlegen" action="" method="post">
					<label for="gruppenname"> Gruppenname: </label>
					<input class="form-control" type="text" id="gruppenname" maxlength="30" placeholder="Gruppenname" style="margin-left:20px"><br><br>
					<label>Mitglied hinzufügen: </label>
					<input class="form-control" type="text" id="mitglied" maxlength="30" placeholder="Mitglied hinzufügen" style="margin-left:20px">

				</form>
			</div>


			<?php
		}
		?>


	</div>



</div>

<?php
include ("includes/includeFooter.php");
?>
</body>
</html>
