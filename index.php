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

		var XMLreq, name, refDatum, refEssenErgebnis, refNeu, refChatAusgabe, refChatEingabe, essen, heute, tag, monat, jahr, datum_heute, nachricht, json1, json2, json3, jsonNeu2, jsonNeu2, jsonNeu3;
		var essenNamen = [];
		function name_ausgeben() { //session in js variable speichern
			name = "<?php if(isset($_SESSION['username']))echo $_SESSION['username'] ?>";
			//alert("Hallo " + name);
		}

		function datum() {  //datuum init
			heute = new Date();
			tag = heute.getDate();
			monat = heute.getMonth() + 1;
			jahr = heute.getFullYear();
			datum_heute = jahr + "-0" + monat + "-" + tag;
			refDatum = document.getElementById('datum');
			//refDatum.innerHTML = datum_heute;
			//$.post('index.php', {variable: datum_heute});
		}

		function essenErgebnis() {
			refEssenErgebnis = document.getElementById('essenErgebnis');
			var count = 1, temp = 0, tempCount;
			var popular = essenNamen[0];
			for (var i = 0; i < (essenNamen.length - 1); i++)
			{
				temp = essenNamen[i];
				tempCount = 0;
				for (var j = 1; j < essenNamen.length; j++)
				{
					if (temp == essenNamen[j])
						tempCount++;
				}
				if (tempCount > count)
				{
					popular = temp;
					count = tempCount;
				}
			}
			refEssenErgebnis.innerHTML = popular;
			/*		else {
			 var rand = Math.floor(Math.random() * essenNamen.length);
			 refEssenErgebnis.innerHTML = essenNamen[rand];
			 }	*/
		}


		-->
	</script>
</head>
<body>

<?php
include ("includes/includeBody.php");
?>


<script> datum(); //datuum init</script>

<!-- Page Content -->
<div class="container" id="container" style="display: none">

	<?php
	$stmt1 = $pdo->prepare("SELECT g_ID FROM users WHERE u_ID = :u_ID");
	$stmt1->execute(array('u_ID' => $_SESSION['userid']));
	$g_ID = $stmt1->fetch();
	if(!isset($g_ID[0])) echo "Keine Gruppe";
	else {
		$stmt2 = $pdo->prepare("SELECT name FROM gruppe WHERE g_ID = :g_ID");
		$stmt2->execute(array('g_ID' => $g_ID[0]));
		$gruppenname = $stmt2->fetch();
		//echo "Deine Gruppe: " . $gruppenname[0];
	}
	?>
	<!-- First Featurette -->
	<div class="featurette" id="about">

		<br><br>
		<script> name_ausgeben(); //session in js variable speichern</script>

		<?php
		if(!isset($g_ID[0])) { //noch keine Gruppe?
		?>
			<h1>Bitte gründe eine Gruppe!</h1>

		<?php
		}
		else { //bereits eine Gruppe
		?>
		<div class="col-md-7">
			<div id="headline">
				<h1>Auswertung für Gruppe <?php echo $gruppenname[0];?></h1><br>
			</div>
			Ergebnis von heute : <div id="essenErgebnis"> </div><br><br>
			<?php
			$abfrage1 = "SELECT datum FROM abstimmen ORDER BY datum DESC";
			$ergebnis1 = mysqli_query($connection, $abfrage1);
			//$datum = mysqli_result(mysqli_query($connection, "SELECT datum FROM tabelle1 LIMIT 1"),0);
			//echo "Essenswünsche am ". $datum . "<br><br>";
			while ($row1 = mysqli_fetch_object($ergebnis1))
			{
				?>
				<p>
				Datum: <?php echo $row1->datum; ?> <br>
				<?php //abfrage beinhaltet Fehler im Hinblick auf Gruppen und datum --> sollte zu gegebener Zeit nochmal ganz neu gemacht werden!
				$abfrage2 = "SELECT username, e_ID1 FROM users, abstimmen WHERE users.u_ID = abstimmen.u_ID AND abstimmen.datum = '$row1->datum' AND users.g_ID=$g_ID[0]";
				$ergebnis2 = mysqli_query($connection, $abfrage2);
				while ($row2 = mysqli_fetch_object($ergebnis2))
				{
					?>
					<p>
						Name: <?php echo $row2->username; ?> <br>
						Essen: <?php echo $row2->e_ID1; ?> <br>
						<script> //für Ergebnis Berechnung
							if("<?php echo $row1->datum; ?>" == datum_heute) {
								var i = essenNamen.length;
								essenNamen[i] = "<?php echo $row2->e_ID1; ?>"
							}
						</script>
					</p>
					<?php
				}
				?>
				</p>
				<hr>
				<?php
			}
			?>
		</div>
		<div class="col-md-4 col-md-offset-1">
			<div style="border-left: thick solid black;">
			<div class = "panel panel-primary" id="chat_border">
				<div class="panel-heading">Chat</div>
				<div class="panel-body">
					<div id="chat_ausgabe"></div>
					<div id="chat_eingabe" style="margin-left: 10px">
						<form class="form-inline" role="form" id="formChat" name="formChat" action="" method="post" onsubmit="chat_speichern(); return false;">
							<input class="form-control" id="nachricht" type="text" placeholder="schreiben..."/>
							<button class="btn btn-dafualt" type="submit">Senden</button>
						</form>
					</div>
				</div></div>
			</div>
		</div>
		<script>
			chat_laden(); // läd chat jede sekunde neu.
			chat_verspätet();
			essenErgebnis();
			scrollen_verspätet();
		</script>
		<?php
		} //ende php abfrage
		?>

	</div>
	<br><br>

</div>
<div id="loggedOutSeite" style="display: none">
	<h1> Willkommen </h1>
	<h2> Bitte logge dich ein :) </h2>
</div>

<?php
include ("includes/includeFooter.php");
?>
</body>
</html>
