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
	function woche_abholen() {
		// hole alle Datumswerte, für die es Einträge in der Tabelle "abstimmung_ergebnis" gibt
	}

	function datum_refreshen() {
		// schaue nach, was für eine Woche in der Dropdown-Liste steht und hole die entsprechenden Einträge aus der DB
	}


-->
</script>
</head>
<body>

<?php
	include ("includes/includeBody.php");
?>
<div class="container" id="container" style="display: none">

	<!-- First Featurette -->
	<div class="featurette" id="about">

		<br><br>
		<div class="col-md-7">
			<div>
				<h1>Verlauf</h1>
				<div></div>
				<br><br>

				<form id="verlauf" name="verlauf" action="" method="post" onsubmit="datum_refreshen();">
					<label for="woche">Woche auswählen:</label>
					<select id="woche" name="woche">
					</select>
					<button type="submit">Anwenden</button>
					<div></div>


				</form>

			</div>

		</div>
	</div>
</div>
<script>woche_abholen()</script>
	<?php
		include ("includes/includeFooter.php");
	?>
</body>
</html>
