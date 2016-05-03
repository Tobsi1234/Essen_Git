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
		// Hole bei jedem Neuladen der Seite die Abstimmung von heute
		function holeAbstimmungenHeute() {
			$.ajax({
				type    : "POST",
				url     : "procedures.php",
				data    : {callFunction: 'getAbstimmungenHeute'},
				dataType: 'text',
				success : function (data) {
					
					var abstimmungen = JSON.parse(data);
					
					if(abstimmungen.toString() === '') {
						$('#essenErgebnis').html("<h2>"+"Noch keine Abstimmung für heute vorhanden"+"</h2>");
					}

					$('#abstimmungen').html("");
					
					for (var i = 0; i<abstimmungen.length; i++) {

						if (abstimmungen[i]['essen1'] === abstimmungen[i]['essen2']) {
							$('#abstimmungen').append("<b>"+abstimmungen[i]['username']+"</b>"+" hat <b>doppelt</b> für das Essen "+"<b>"+abstimmungen[i]['essen1']+"</b>"+"</b>"+" abgestimmt.<br>");
						}
						else if (abstimmungen[i]['essen2'] != null) {
							$('#abstimmungen').append("<b>"+abstimmungen[i]['username']+"</b>"+" hat für die Essen "+"<b>"+abstimmungen[i]['essen1']+"</b>"+" und "+"<b>"+abstimmungen[i]['essen2']+"</b>"+" abgestimmt.<br>");
						}
						else {
							$('#abstimmungen').append("<b>"+abstimmungen[i]['username']+"</b>"+" hat <b>nur</b> für das Essen "+"<b>"+abstimmungen[i]['essen1']+"</b>"+"</b>"+" abgestimmt.<br>");
						}
					}
				}
			});
		}

		function berechneErgebnisHeute() {
			$.ajax({
				type    : "POST",
				url     : "procedures.php",
				data    : {callFunction: 'calculateErgebnisHeute'},
				dataType: 'text',
				success : function (data) {
					// alert(data);
					var location = JSON.parse(data);
					var linker = "";
					// alert(location['abstimmungen']+location[0]['locname']+location[1]['locname']+location[2]['locname']);
					$('#essenErgebnis').html("");

					// Wenn Abstimmungen vorhanden sind, aber keine Location für diese Abstimmung da ist
					if(location[0]['abstimmungen'] === true && location[0]['locname'] === undefined) {
						$('#essenErgebnis').html("<h2>"+"Für diese Abstimmungen existiert leider keine passende Location."+"</h2>");
					}
					// Wenn weder Abstimmungen noch Locations da sind
					else if (location[0]['abstimmungen'] === false){
						// do nothing
					}

					else {
						// Wenn Locations und damit auch Abstimmungen da sind
							if (location.length > 0)
								$('#essenErgebnis').append("<h2>"+"Die heutige Essensempfehlung ist \""+location[0]['locname']+"\""+"</h2>");
							if (location.length > 2)
								linker = ", "+location[2]['locname'];
							if (location.length > 1)
								$('#essenErgebnis').append("<br><h4>Alternative/n: "+location[1]['locname']+linker+"</h4>");
					}

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




<!-- Page Content -->
<div class="container weiß" id="container" style="display: none">

	<?php
	$stmt1 = $pdo->prepare("SELECT g_ID FROM users WHERE u_ID = :u_ID");
	$stmt1->execute(array('u_ID' => $_SESSION['userid']));
	$g_ID = $stmt1->fetch();
	if(!isset($g_ID[0])) echo "";
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

		<script> datum(); //datum init</script>
		<script>holeAbstimmungenHeute();</script>
		<script>berechneErgebnisHeute();</script>

		<div class="col-md-7">
			<div id="headline">
				<h1>Auswertung für Gruppe "<?php echo $gruppenname[0];?>":</h1><br>
			</div>
			<div id="essenErgebnis"> </div><br><br>
			<div id="abstimmungen"></div>
			<br><br>
		</div>

		<div class="col-md-4 col-md-offset-1">
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
				</div>
			</div>
		</div>
		<script>
			chat_laden(); // läd chat jede sekunde neu.
			chat_verspätet();
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
