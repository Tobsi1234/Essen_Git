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
		function emailPrüfen() {
			var email = $('#mitglied').val();
			$.ajax({
				type: "POST",
				url: "procedures.php",
				data: {callFunction: 'emailPrüfen', email: email},
				dataType: 'text',
				success:function(data) {
					mitgliedHinzufügen(data);
				}
			});
		}

		function mitgliedHinzufügen(name) {
			if(name) {
				$('#bisherHinzugefügt').append(name + " ");
				$('#fehlermeldung').hide();
			}
			else {
				$('#fehlermeldung').html("Person nicht vorhanden oder bereits vorhanden");
				$('#fehlermeldung').show();
			}
		}

		function gruppeErstellen() {
			var u_ID = "<?php echo $_SESSION['userid'] ?>";
			var name = $('#gruppenname').val();
			alert(name + " : " + u_ID);
			$.ajax({
				type: "POST",
				url: "procedures.php",
				data: {callFunction: 'gruppeErstellen', name: name, u_ID: u_ID},
				dataType: 'text',
				success:function(data) {
				}
			});
		}
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
	$stmt2->execute(array('g_ID' => $g_ID[0]));
	$gruppenname = $stmt2->fetch();
	echo "Deine Gruppe" . $gruppenname[0];
}
?>

<!-- Page Content -->
<div class="container">
	<div class="alert alert-danger" id="fehlermeldung" style="display:none">
	</div>
	<!-- First Featurette -->
	<div class="featurette" id="about">
		<?php
		if(!isset($g_ID[0])) {
			?>
			<div id="headline">
				<h1>Neue Gruppe anlegen: </h1><br>
			</div>
			<div class="form-horizontal">
				<form class="form-inline" id="formAnlegen" name="formAnlegen" action="" onsubmit="gruppeErstellen();" method="post">
					<label for="gruppenname"> Gruppenname: </label>
					<input class="form-control" type="text" id="gruppenname" maxlength="30" placeholder="Gruppenname" style="margin-left:20px" required><br><br>
					<label>Mitglied hinzufügen: </label>
					<input class="form-control" type="text" id="mitglied" maxlength="30" placeholder="E-Mail" style="margin-left:20px">
					<button type="button" class="btn btn-default" onclick="emailPrüfen();">Hinzufügen</button><br><br>
					<div id="bisherHinzugefügt">
						<label>Bisher hinzugefügt: </label>
					</div><br>
					<button type="submit" class="btn btn-primary">Gruppe erstellen</button>
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
