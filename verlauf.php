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

// Methode aus dem Internet, wo man ein Datum reingibt, um die aktuelle Kalenderwoche als Zahl zu bekommen
	function getWeekNumber(date) {
		// date = new Date(+date);
		date.setHours(0,0,0);
		date.setDate(date.getDate() + 4 - (date.getDay()||7));
		var yearStart = new Date(date.getFullYear(),0,1);
		var weekNo = Math.ceil(( ( (date - yearStart) / 86400000) + 1)/7);
		date.setMilliseconds(0);
		return [weekNo, date.getFullYear()];
	}

// Methode aus dem Internet, wo man ein Datum reingibt, um die aktuelle Kalenderwoche in Tagen (erster und letzter Tag der Woche) zu bekommen
	function getDaysOfWeek(date) {

		date.setDate(date.getDate()-1);
		var first = (date.getDate() - date.getDay())+1;

		var firstday = new Date(date.setDate(first));
		var lastday = new Date(date.setDate(firstday.getDate()+6));

		return [firstday, lastday];
	}

// Eigene Funktion, die für das Datum den String so formatiert, dass er der Dropdown-Liste hinzugefügt werden kann
	function getFormattedDropdownString(date) {
		var local1 = date;
		var local2 = date;
		// alert("Local1 vorher:"+local1);
		//alert("Local2 vorher:"+local2);
		var week = getDaysOfWeek(local1);
		//alert("Local1 nachher:"+local1);
		//alert("Local2 nachher:"+local2);
		var weeknumber = getWeekNumber(local2);

		var weeknumberString = weeknumber[0]+", "+weeknumber[1];


		var firstDay, lastDay, firstMonth, lastMonth;

		// Dieser if-else-Block hängt bei Tagen und Monaten eine Null vornean, wenn sie nicht zweistellig sind (wichtig für das Auslesen in Funktion "datum_refreshen")!
		if (week[0].getDate() < 10) firstDay = "0"+week[0].getDate(); else firstDay = week[0].getDate();
		if (week[1].getDate() < 10) lastDay = "0"+week[1].getDate(); else lastDay = week[1].getDate();
		if ((week[0].getMonth()+1) < 10) firstMonth = "0"+(week[0].getMonth()+1); else firstMonth = (week[0].getMonth()+1);
		if ((week[1].getMonth()+1) < 10) lastMonth = "0"+(week[1].getMonth()+1); else lastMonth = (week[1].getMonth()+1);

		var firstdate = firstDay+"."+firstMonth+".";
		var lastdate = lastDay+"."+lastMonth+".";

		// var dropdownInhalt = "KW "+weeknumberString+" ("+firstdate+" - "+lastdate+")";
		// var dropdownInhalt = firstdate+week[0].getFullYear()+" - "+lastdate+week[1].getFullYear()+" (KW "+weeknumber[0]+")";
		var dropdownInhalt = firstdate+" - "+lastdate+" (KW "+weeknumberString+")";

		return dropdownInhalt;


	}
// hole alle Datumswerte, für die es Einträge in der Tabelle "abstimmung_ergebnis" gibt
	function woche_abholen() {

			$.ajax({
			type    : "POST",
			url     : "procedures.php",
			data    : {callFunction: 'getDatesFromAbstimmung'},
			dataType: 'text',
			success : function (data) {
				var allDates = JSON.parse(data);
				for (var i = 0; i<allDates.length; i++) {
					var date = new Date(allDates[i]['datum']);
					// alert(date);
					var dropdownInhalt = getFormattedDropdownString(date);
					var exists = false;

					$('#woche').each(function() {
						if (this.value == dropdownInhalt) {
							exists = true;
							return false;
						}
					});
					// Überprüfung, ob Woche bereits in Dropdown-Liste
					if (exists == false) {
						$('#woche').append($('<option>', {
							text: dropdownInhalt
						}));
					}

				}
			}
		});
	}

	function datum_refreshen() {
		// schaue nach, was für eine Woche in der Dropdown-Liste steht und hole die entsprechenden Einträge aus der DB
		$.ajax({
			type    : "POST",
			url     : "procedures.php",
			data    : {callFunction: 'getAbstimmungsErgebnisse'},
			dataType: 'text',
			success : function (data) {
				var ergebnisse = JSON.parse(data);
				var selectedText = $('#woche :selected').text();

				var year = selectedText.substring(24,28);

				var firstDay = selectedText.substring(0,2);
				var firstMonth = selectedText.substring(3,5);
				var firstDate = new Date(year+"-"+firstMonth+"-"+firstDay);

				var lastDay = selectedText.substring(9,11);
				var lastMonth = selectedText.substring(12,14);
				var lastDate = new Date(year+"-"+lastMonth+"-"+lastDay);

				var ergebnisseWoche = [];

				for (var i = 0; i<ergebnisse.length; i++) {
					var current = ergebnisse[i];

					if (new Date(current['datum']) >= firstDate && new Date(current['datum']) <= lastDate) {
						ergebnisseWoche[i] = new Object();
						ergebnisseWoche[i]['datum'] = current['datum'];
						ergebnisseWoche[i]['locname'] = current['locname'];
						ergebnisseWoche[i]['gruppe'] = current['gruppe'];
					}
				}
				// alert("Länge: "+ergebnisseWoche.length);

				for (var i = 0; i<ergebnisseWoche.length; i++) {
					// Ergebnisse ausgeben
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
					<div class="abstimmungen" id="abstimmungen">
					</div>


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
